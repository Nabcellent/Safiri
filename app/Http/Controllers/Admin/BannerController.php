<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response {
        $data = [
            'banners' => Banner::all()
        ];

        return response()->view('admin.banners.upsert', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreBannerRequest $request): RedirectResponse {
        try {
            $data = $request->except('_token');

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $data['image'] = "ban_" . time() . ".{$file->guessClientExtension()}";
                $file->move(public_path('images/banners'), $data['image']);
            }

            Banner::create($data);

            return createOk("Banner Created successfully! ✔");
        } catch (Exception $e) {
            return toastError($e->getMessage(), 'Unable to create banner');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function edit(int $id): Response|RedirectResponse {
        try {
            $data = [
                'banner'  => Banner::findOrFail($id),
                'banners' => Banner::all()
            ];

            return response()->view('admin.banners.upsert', $data);
        } catch (Exception $e) {
            return toastError($e->getMessage(), 'Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $data = $request->except('_token');

            $banner = Banner::findOrFail($id);

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $data['image'] = "ban_" . time() . ".{$file->guessClientExtension()}";
                $file->move(public_path('images/banners'), $data['image']);

                if(isset($banner->image) && file_exists("images/banners/{$banner->image}")) {
                    unlink(public_path('images/banners/' . $banner->image));
                }
            }

            $banner->update($data);

            return updateOk("Banner Updated successfully! ✔");
        } catch (Exception $e) {
            return toastError($e->getMessage(), 'Unable to create banner');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse {
        try {
            Banner::destroy($id);

            return deleteOk();
        } catch (Exception $e) {
            return toastError($e->getMessage(), 'Unable to delete banner');
        }
    }
}
