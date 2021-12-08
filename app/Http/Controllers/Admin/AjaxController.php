<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Help;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class AjaxController extends Controller {
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function destroy(Request $request): Response {
        $id = (int)$request->id;
        $reqModel = $request->input('model');
        $table = Str::snake(Str::plural($reqModel));
        $model = Help::getModel($reqModel);

        $path = '';

        if($table === 'destinations') {
            $name = Destination::find($id)->image;
            $path = "images/destinations/{$name}";
        }

        if(Storage::exists($path)) Storage::delete($path);

        return DB::transaction(function() use ($reqModel, $id, $model) {
            if($model::destroy($id)) return response('success');

            return response("unable to delete $reqModel.", 500);
        });
    }
}
