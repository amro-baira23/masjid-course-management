<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkDestroyAgeGroupRequest;
use App\Http\Requests\BulkStoreAgeGroupRequest;
use App\Models\AgeGroup;
use App\Http\Requests\StoreAgeGroupRequest;
use App\Http\Requests\UpdateAgeGroupRequest;
use App\Http\Resources\AgeGroupResource;

class AgeGroupController extends Controller
{
    public function index()
    {
        $age_groups = AgeGroup::paginate(10);
        return AgeGroupResource::collection($age_groups);
    }

    public function store(StoreAgeGroupRequest $request)
    {
        $age_group = AgeGroup::create([
            "name" => $request->name,
        ]);
        return AgeGroupResource::make($age_group);
    }

    public function bulkStore(BulkStoreAgeGroupRequest $request)
    {
        $age_groups = [];
        foreach($request->age_groups as $ag){
            $age_groups[] = AgeGroup::create([
            "name" => $ag["name"],
            ]);
        }
        return AgeGroupResource::collection($age_groups);
    }

    public function show(AgeGroup $ageGroup)
    {
        //
    }

    public function update(UpdateAgeGroupRequest $request, AgeGroup $ageGroup)
    {
        //
    }

    public function destroy(AgeGroup $ageGroup)
    {
        //
    }

     public function bulkDelete(BulkDestroyAgeGroupRequest $request)
    {
        AgeGroup::destroy($request->age_group_ids);
    }
}
