<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\Diagnosis;

class DiagnosisController extends Controller
{
    /**
     * Show the diagnostic form (Symptom Selection).
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return view('diagnosis.index', compact('symptoms'));
    }

    /**
     * Process the diagnostic logic (Forward Chaining).
     */
    public function process(Request $request)
    {
        $request->validate([
            'symptoms' => 'required|array|min:1',
            'symptoms.*' => 'exists:symptoms,id',
        ]);

        $selectedSymptomIds = $request->input('symptoms');
        $diagnoses = Diagnosis::with('symptoms')->get();
        $results = [];

        foreach ($diagnoses as $diagnosis) {
            $matchingSymptoms = 0;
            $totalSymptoms = $diagnosis->symptoms->count();

            // Skip diagnosis with no rules
            if ($totalSymptoms === 0) continue;

            $matchedSymptomNames = [];

            foreach ($diagnosis->symptoms as $symptom) {
                if (in_array($symptom->id, $selectedSymptomIds)) {
                    $matchingSymptoms++;
                    $matchedSymptomNames[] = $symptom->name;
                }
            }

            if ($matchingSymptoms > 0) {
                // Calculation: (Matches / Total Required) * 100
                $percentage = ($matchingSymptoms / $totalSymptoms) * 100;
                
                $results[] = [
                    'diagnosis' => $diagnosis,
                    'percentage' => round($percentage, 2),
                    'matches' => $matchingSymptoms,
                    'matched_symptoms' => $matchedSymptomNames
                ];
            }
        }

        // Sort by percentage descending
        usort($results, function ($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });

        // Get the top result
        $topResult = count($results) > 0 ? $results[0] : null;

        return view('diagnosis.result', compact('results', 'topResult'));
    }
}
