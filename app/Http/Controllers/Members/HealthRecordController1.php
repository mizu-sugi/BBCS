<?php

namespace App\Http\Controllers\Members;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Members\StoreHealthRecordRequest;
use App\Models\HealthRecord;
use Illuminate\Auth\Access\AuthorizationException;

class HealthRecordController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function index()
    {
        $member = Auth::guard('members')->user();
        $healthRecords = HealthRecord::where('member_id', $member->id)
            ->latest('updated_at')
            ->paginate(10);

        return view('members.health-records.index', compact('healthRecords', 'member'));
    }

    public function create()
    {
        return view('members.health-records.create');
    }

    public function store(StoreHealthRecordRequest $request)
    {
        $member = Auth::guard('members')->user();
        
        $record = new HealthRecord($request->validated());
        $record->member_id = $member->id;
        $record->save();

        return redirect()->route('members.health-records.index')->with('success', 'Record added successfully.');
    }

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




