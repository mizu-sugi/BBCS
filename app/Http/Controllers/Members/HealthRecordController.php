<?php

namespace App\Http\Controllers\Members;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Members\StoreHealthRecordRequest;
use App\Models\HealthRecord;
use Illuminate\Auth\Access\AuthorizationException;

class HealthRecordController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function index(Request $request)
    {
       
        $query = HealthRecord::where('member_id', auth()->id());

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    
     


          
        $records = $query->get();
        

        //$records = HealthRecord::where('member_id', auth()->id())->get();


        $labels = $records->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        })->toArray();
        $temperatures = $records->pluck('temperature')->toArray();
        $nauseaLevels = $records->pluck('nausea_level')->toArray();
        $fatigueLevels = $records->pluck('fatigue_level')->toArray();
        $painLevels = $records->pluck('pain_level')->toArray();
        $appetiteLevels = $records->pluck('appetite_level')->toArray();
        $numbnessLevels = $records->pluck('numbness_level')->toArray();
        $anxietyLevels = $records->pluck('anxiety_level')->toArray();

        return view('members.health-records.index', compact('records', 'labels', 'temperatures', 'nauseaLevels', 'fatigueLevels', 'painLevels', 'appetiteLevels', 'numbnessLevels', 'anxietyLevels'));
    }

    public function create()
    {
        return view('members.health-records.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'temperature' => 'required|numeric',
        'nausea_level' => 'required|integer|between:1,5',
        'fatigue_level' => 'required|integer|between:1,5',
        'pain_level' => 'required|integer|between:1,5',
        'appetite_level' => 'required|integer|between:1,5',
        'numbness_level' => 'required|integer|between:1,5',
        'anxiety_level' => 'required|integer|between:1,5',
        'memo' => 'nullable|string',
    ]);

    $healthRecord = new HealthRecord();
    $healthRecord->temperature = $request->temperature;
    $healthRecord->nausea_level = $request->nausea_level;
    $healthRecord->fatigue_level = $request->fatigue_level;
    $healthRecord->pain_level = $request->pain_level;
    $healthRecord->appetite_level = $request->appetite_level;
    $healthRecord->numbness_level = $request->numbness_level;
    $healthRecord->anxiety_level = $request->anxiety_level;
    $healthRecord->memo = $request->memo;
    $healthRecord->member_id = \Illuminate\Support\Facades\Auth::id(); // 現在のログインユーザーのIDを設定
    $healthRecord->save();

    return redirect()->route('members.health-records.index')->with('success', 'Health record created successfully.');
}

    public function show($id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        return view('members.health-records.show', compact('healthRecord'));
    }

//     public function edit($id)
// {
//     $healthRecord = HealthRecord::findOrFail($id);
//     return view('members.health-records.edit', compact('healthRecord'));
// }

// public function update(Request $request, $id)
// {
//     $validatedData = $request->validate([
//         'temperature' => 'required|numeric',
//         'nausea_level' => 'required|integer|between:1,5',
//         'fatigue_level' => 'required|integer|between:1,5',
//         'pain_level' => 'required|integer|between:1,5',
//         'appetite_level' => 'required|integer|between:1,5',
//         'numbness_level' => 'required|integer|between:1,5',
//         'anxiety_level' => 'required|integer|between:1,5',
//         'memo' => 'nullable|string|max:1000',
//     ]);

//     $healthRecord = HealthRecord::findOrFail($id);
//     $healthRecord->update($validatedData);

//     return redirect()->route('members.health-records.show', $healthRecord->id)
//                      ->with('success', '健康記録が更新されました');
// }

// public function destroy($id)
// {
//     $healthRecord = HealthRecord::findOrFail($id);
//     $healthRecord->delete();

//     return redirect()->route('members.health-records.index')
//                      ->with('success', '健康記録が削除されました');
// }

    public function edit($id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        $this->authorize('view', $healthRecord); // ポリシーで権限を確認

        return view('members.health-records.edit', compact('healthRecord'));
    }

    public function update(StoreHealthRecordRequest $request, $id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        $this->authorize('view', $healthRecord); // ポリシーで権限を確認

        $healthRecord->fill($request->validated());
        $healthRecord->save();

        return redirect()->route('members.health-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy($id)
    {
        $healthRecord = HealthRecord::findOrFail($id);
        $this->authorize('view', $healthRecord); // ポリシーで権限を確認

        $healthRecord->delete();

        return redirect()->route('members.health-records.index')->with('success', 'Record deleted successfully.');
    }
}