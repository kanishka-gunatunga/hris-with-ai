<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtherAdminDetails;
use App\Models\OtherHRManagerDetails;
use App\Models\OtherEmployeeDetails;
use App\Models\Designations;
use App\Models\Departments;
use App\Models\Immigrations;
use App\Models\Contacts;
use App\Models\SocialProfile;
use App\Models\Documents;
use App\Models\Qulifications;
use App\Models\Works;
use App\Models\BankAccounts;
use App\Models\BasicSalary;
use App\Models\Allowances;
use App\Models\Commissions;
use App\Models\Loans;
use App\Models\Deductions;
use App\Models\OtherPaymnets;
use App\Models\Overtimes;
use App\Models\Pensions;
use App\Models\CoreHRPromotions;
use App\Models\CoreHRAwards;
use App\Models\CoreHRTravel;
use App\Models\CoreHRTransfer;
use App\Models\CoreHRResignations;
use App\Models\CoreHRComplaints;
use App\Models\CoreHRWarnings;
use App\Models\CoreHRTerminations;
use App\Models\OtherClientDetails;
use App\Models\PMProjects;
use App\Models\PMProjectsEmployees;
use App\Models\PMTasks;
use App\Models\PMTaskUsers;
use App\Models\PMTaxTypes;
use App\Models\PMInvoices;
use App\Models\PMInvoiceItems;
use App\Models\OrganizationDepartments;
use App\Models\OrganizationLocations;
use App\Models\OrganizationDesignations;
use App\Models\OrganizationAnnouncements;
use App\Models\OrganizationPolicy;
use App\Models\Events;
use App\Models\Meetings;
use App\Models\PerformanceGoalType;
use App\Models\PerformanceGoalTracking;
use App\Models\PerformanceIndicator;
use App\Models\PerformanceAppraisal;
use App\Models\TrainingTrainers;
use App\Models\TrainingType;
use App\Models\TrainingList;
use App\Models\TrainingListEmployees;
use App\Models\FinanceAccountList;
use App\Models\FinancePayer;
use App\Models\FinancePayee;
use App\Models\FinanceDeposit;
use App\Models\FinanceExpense;
use App\Models\FinanceTransfer;
use App\Models\FinancePayment;
use App\Models\AssetCategory;
use App\Models\Asset;
use App\Models\FileManager;
use App\Models\FileOfficialDocument;
use App\Models\OfficeShift;
use App\Models\Holidays;
use App\Models\Leaves;
use App\Models\Attendance;
use App\Models\JobPosts;
use App\Models\OtherHODDetails;
use App\Models\BlockedIPS;
use App\Models\LeaveTypes;
use App\Models\SpecialLeavesDeduction;
use App\Models\EventsDepartments;
use App\Models\Recruitments;
use App\Models\InterviewUpdates;
use App\Models\InterviewOtherUpdates;
use App\Models\EmploymentTypeHistory;
use App\Models\UserCheckInOutData;
use App\Models\OtherAuthoriserDetails;
use App\Models\UserCustomLeaves;
use App\Models\Accessories;
use App\Models\EmployeeAccessories;
use App\Models\TrainingCourses;
use App\Models\TrainingCourseMaterials;
use File;
use PDF;
use Mail;
use League\Csv\Writer;

date_default_timezone_set('Asia/Colombo');

class NewFeaturesController extends Controller
{
   

    public function training_courses(Request $request)
    {
    if($request->isMethod('get')){
    $courses = TrainingCourses::get();
    return view('training_courses', ['courses' => $courses]);
    }
    if($request->isMethod('post')){
        $this->validate($request, [
            'title'   => 'required',
            'materials'   => 'required',
            'discription'   => 'required'
        ]);

        $course =  new TrainingCourses();
        $course->title =$request->title;
        $course->discription =$request->discription;
        $course->save();
        
        if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $filename = $course->id . $file->getClientOriginalName();
                $file->move(public_path('course_materials/'), $filename);
                TrainingCourseMaterials::create([
                    'course_id' => $course->id,
                    'file' => $filename,
                ]);
            }
        }
            
        return back()->with('success', 'Course Created');
    }

    }
    public function delete_training_trainers($id){
        TrainingTrainers::find($id)->delete();
        return back()->with('success', 'Trainer Successfully  Deleted');
    }
    public function edit_training_course($id,Request $request)
    {

        if($request->isMethod('get')){
            $course_details = TrainingCourses::where('id',$id)->first();
            $materials = TrainingCourseMaterials::where('course_id',$id)->get();
            return view('edit_training_course', ['course_details' => $course_details,'materials' => $materials]);
            }
        if($request->isMethod('post')){

        $this->validate($request, [
            'title'   => 'required',
            'discription'   => 'required'
        ]);
            $course =  TrainingCourses::where('id', '=', $id)->first();;
            $course->title =$request->title;
            $course->discription =$request->discription;
            $course->update();
            
            if ($request->hasFile('materials')) {
            foreach ($request->file('materials') as $file) {
                $filename = $id . $file->getClientOriginalName();
                $file->move(public_path('course_materials/'), $filename);
                TrainingCourseMaterials::create([
                    'course_id' =>$id,
                    'file' => $filename,
                ]);
            }
        }
        
            return back()->with('success', 'Course  Details Successfully  Updated');
            }


    }
    


public function search_cvs(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('cv.search_cvs');
        }

        if ($request->isMethod('post')) {
            $request->validate(['qualifications' => 'required']);

            // 1. Semantic Analysis: Extract Filters & Refined Query using cURL
            $analysis = $this->analyzeSearchQueryWithCurl($request->qualifications);

            $filters = $analysis['filters'] ?? [];
            $refinedText = $analysis['refined_text'] ?? $request->qualifications;

            // 2. Generate Embedding from the Refined Text using cURL
            $queryEmbedding = $this->generateEmbeddingWithCurl($refinedText);

            if (!$queryEmbedding) {
                return back()->withErrors(['qualifications' => 'Embedding service failed.']);
            }

            // 3. Build Pinecone Filter Object
            $pineconeFilter = [];

            // CRITICAL: If a specific candidate name is mentioned, filter by name
            if (!empty($filters['candidate_name'])) {
                $pineconeFilter['name_lowercase'] = ['$eq' => strtolower(trim($filters['candidate_name']))];
            }

            // Map age constraints
            if (!empty($filters['age_max'])) {
                $pineconeFilter['age'] = ['$lte' => (int) $filters['age_max']];
            }
            if (!empty($filters['age_min'])) {
                if (isset($pineconeFilter['age'])) {
                    $pineconeFilter['age']['$gte'] = (int) $filters['age_min'];
                } else {
                    $pineconeFilter['age'] = ['$gte' => (int) $filters['age_min']];
                }
            }

            // Gender filter
            if (!empty($filters['gender']) && strtolower($filters['gender']) !== 'any') {
                $pineconeFilter['gender'] = ['$eq' => ucfirst(strtolower($filters['gender']))];
            }

            // Experience filter
            if (!empty($filters['experience_min'])) {
                $pineconeFilter['years_experience'] = ['$gte' => (float) $filters['experience_min']];
            }

            // 4. Query Pinecone using cURL
            $payload = [
                'vector' => $queryEmbedding,
                'topK' => 3,
                'includeMetadata' => true,
            ];

            if (!empty($pineconeFilter)) {
                $payload['filter'] = $pineconeFilter;
            }

            $matches = $this->queryPineconeWithCurl($payload);

            if ($matches === null) {
                return back()->withErrors(['qualifications' => 'Search service failed.']);
            }

            // 5. Process Results
            $results = [];
            foreach ($matches as $match) {
                // Use a threshold of 0.25 for semantic matching
                if (($match['score'] ?? 0) >= 0.25) {
                    $rec = Recruitments::find($match['metadata']['recruitment_id'] ?? 0);
                    if ($rec) {
                        $job = JobPosts::find($rec->job_post);

                        // Build skills string from metadata
                        $skillsList = $match['metadata']['skills'] ?? [];
                        $skillsStr = is_array($skillsList) ? implode(', ', $skillsList) : $skillsList;

                        $results[] = [
                            'name' => $rec->name,
                            'email' => $rec->email,
                            'phone' => $rec->phone,
                            'location' => $match['metadata']['location'] ?? $rec->location,
                            'cv' => $rec->cv,
                            'job_title' => $job ? $job->job_title : 'N/A',
                            'experience' => $match['metadata']['years_experience'] ?? 0,
                            'gender' => $match['metadata']['gender'] ?? 'N/A',
                            'role' => $match['metadata']['role'] ?? 'N/A',
                            'skills' => $skillsStr,
                            'university' => $match['metadata']['university'] ?? 'N/A',
                            'degree' => $match['metadata']['degree_program'] ?? 'N/A',
                            'score' => round(($match['score'] ?? 0) * 100, 2),
                            'matched_criteria' => $this->explainMatch($match, $filters)
                        ];
                    }
                }
            }

            // Sort by score descending
            usort($results, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            return view('cv.search_cvs', [
                'results' => $results,
                'search_query' => $request->qualifications,
                'debug_filters' => $pineconeFilter
            ]);
        }
    }


    private function explainMatch($match, $filters)
    {
        $reasons = [];

        if (!empty($filters['candidate_name'])) {
            $reasons[] = "Name: " . $filters['candidate_name'];
        }
        if (!empty($filters['age_max'])) {
            $reasons[] = "Age < " . $filters['age_max'];
        }
        if (!empty($filters['experience_min'])) {
            $reasons[] = "Exp > " . $filters['experience_min'] . "y";
        }
        if (!empty($filters['university'])) {
            $reasons[] = "University: " . $filters['university'];
        }
        if (!empty($filters['degree'])) {
            $reasons[] = "Degree: " . $filters['degree'];
        }

        return implode(", ", $reasons);
    }


//     private function analyzeSearchQueryWithCurl($userQuery)
//     {
//         $prompt = <<<PROMPT
// Role: Search Logic Analyzer for HR/Recruitment System.
// Task: Parse the recruiter's query into structured Filters and a Cleaned Semantic Query.

// Query: "{$userQuery}"

// **CRITICAL INSTRUCTIONS:**

// 1. **Candidate Name Detection**:
//   - If the query mentions a SPECIFIC person's name (e.g., "John Smith", "Show me John's resume"), extract it into "candidate_name".
//   - This is the MOST IMPORTANT filter - if a name is mentioned, ONLY that person's resume should be returned.
//   - Example: "find John Smith's resume" -> candidate_name: "John Smith"
//   - Example: "show me sakuna's cv" -> candidate_name: "sakuna"

// 2. Extract HARD constraints for Filters ONLY if explicitly stated:
//   - Age (e.g. "under 25") -> age_max
//   - Experience (e.g. "more than 5 years", "1 year experience") -> experience_min
//   - Gender (e.g. "Male", "man", "she") -> gender
//   - University (e.g. "studied at NIBM", "from MIT") -> university
//   - Degree (e.g. "project management degree", "computer science") -> degree
//   - Do NOT guess. If not mentioned, return null.

// 3. **Entities (Universities, Locations, Skills, Companies)**: 
//   - Extract them in the appropriate filter field if mentioned.
//   - **CRITICAL**: ALWAYS include them in the "refined_text" so the vector search matches them.
//   - Example: If query is "studied at Oxford", refined_text MUST contain "studied at Oxford".
//   - Example: If query is "nodejs developer", refined_text MUST contain "nodejs developer".

// 4. "Refined Text": A description of the ideal candidate including Name, Role, Skills, Location, University, and Degree.
//   - This is used for semantic/vector search.
//   - Include ALL relevant keywords from the query.
//   - Example: "Software engineer with nodejs experience who studied at NIBM doing project management degree under 25 years old"

// Output JSON ONLY:
// {
//   "filters": {
//       "candidate_name": null or "string",
//       "age_min": null or number,
//       "age_max": null or number,
//       "experience_min": null or number,
//       "gender": "Male" or "Female" or "any",
//       "university": null or "string",
//       "degree": null or "string"
//   },
//   "refined_text": "string (the semantic description with all keywords)"
// }
// PROMPT;

//         $ch = curl_init();

//         $postData = json_encode([
//             'model' => 'gpt-4o-mini',
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You output valid JSON only. Be precise about extracting candidate names - if a specific person is mentioned, capture their full name.'],
//                 ['role' => 'user', 'content' => $prompt],
//             ],
//             'temperature' => 0,
//             'max_tokens' => 200,
//         ]);

//         curl_setopt_array($ch, [
//             CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_POST => true,
//             CURLOPT_HTTPHEADER => [
//                 'Content-Type: application/json',
//                 'Authorization: Bearer ' . env('OPENAI_API_KEY'),
//             ],
//             CURLOPT_POSTFIELDS => $postData,
//             CURLOPT_TIMEOUT => 30,
//         ]);

//         $response = curl_exec($ch);
//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//         $curlError = curl_error($ch);
//         curl_close($ch);

//         if ($curlError || $httpCode !== 200) {
//             Log::error('OpenAI Search Analysis Error', [
//                 'error' => $curlError,
//                 'code' => $httpCode,
//                 'response' => $response
//             ]);
//             return ['refined_text' => $userQuery, 'filters' => []];
//         }

//         $data = json_decode($response, true);
//         $content = $data['choices'][0]['message']['content'] ?? '';

//         // Clean markdown code blocks if present
//         $content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));

//         $parsed = json_decode($content, true);
//         return $parsed ?? ['refined_text' => $userQuery, 'filters' => []];
//     }




    private function analyzeSearchQueryWithCurl($userQuery)
    {
        $prompt = <<<PROMPT
Parse HR query: "{$userQuery}"
Output JSON: {"filters":{"candidate_name":null,"age_min":null,"age_max":null,"experience_min":null,"gender":"any","university":null,"degree":null},"refined_text":"..."}
Rules:
- candidate_name: Extract ONLY specific names (e.g. "John Smith").
- refined_text: Semantic string with ALL keywords (skills, role, loc).
- filters: Extract explicit hard constraints (e.g. "under 25"->age_max:25).
PROMPT;

        $ch = curl_init();

        $postData = json_encode([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You output valid JSON only. Be precise about extracting candidate names - if a specific person is mentioned, capture their full name.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0,
            'max_tokens' => 200,
        ]);

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError || $httpCode !== 200) {
            Log::error('OpenAI Search Analysis Error', [
                'error' => $curlError,
                'code' => $httpCode,
                'response' => $response
            ]);
            return ['refined_text' => $userQuery, 'filters' => []];
        }

        $data = json_decode($response, true);
        $content = $data['choices'][0]['message']['content'] ?? '';

        // Clean markdown code blocks if present
        $content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));

        $parsed = json_decode($content, true);
        return $parsed ?? ['refined_text' => $userQuery, 'filters' => []];
    }



    /**
     * Generate text embedding using OpenAI Embeddings API with cURL
     */
    private function generateEmbeddingWithCurl($text)
    {
        $ch = curl_init();

        $postData = json_encode([
            'model' => 'text-embedding-3-small',
            'input' => substr($text, 0, 8000), // OpenAI limit
        ]);

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.openai.com/v1/embeddings',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError || $httpCode !== 200) {
            Log::error('OpenAI Embedding Error', [
                'error' => $curlError,
                'code' => $httpCode,
                'response' => $response
            ]);
            return null;
        }

        $data = json_decode($response, true);
        return $data['data'][0]['embedding'] ?? null;
    }


    private function queryPineconeWithCurl($payload)
    {
        $ch = curl_init();

        $postData = json_encode($payload);

        curl_setopt_array($ch, [
            CURLOPT_URL => env('PINECONE_ENDPOINT') . '/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Api-Key: ' . env('PINECONE_API_KEY'),
            ],
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError || $httpCode !== 200) {
            Log::error('Pinecone Query Error', [
                'error' => $curlError,
                'code' => $httpCode,
                'response' => $response
            ]);
            return null;
        }

        $data = json_decode($response, true);
        return $data['matches'] ?? [];
    }
    
}



