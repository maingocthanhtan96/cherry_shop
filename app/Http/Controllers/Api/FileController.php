<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreAvatarRequest;
use App\Http\Requests\StoreFileRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * upload files
     * @param StoreFileRequest $request
     * @return JsonResponse
     * @author tanmnt
     */
    public static function store(StoreFileRequest $request): JsonResponse
    {
        try {
            if ($request->file('file')) {
                $now = Carbon::now();
                $image = $request->file('file');
                $folderCreate = "/uploads/dropzone/$now->year/$now->month/$now->day";
                $diskLocal = Storage::disk();
                $fileName = $diskLocal->put($folderCreate, $image);

                return (new self())->jsonData($diskLocal->url($fileName));
            }

            return (new self())->jsonMessage(trans('error.file_not_found'), false, 500);
        } catch (\Exception $e) {
            return (new self())->jsonError($e);
        }
    }

    /**
     * remove file
     * @param Request $request
     * @return JsonResponse
     * @author
     */
    public static function remove(Request $request): JsonResponse
    {
        try {
            $file = $request->get('file', '');
            if ($file) {
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                } else {
                    return (new self())->jsonMessage(trans('error.file_not_found'), false, 500);
                }
            }
            return (new self())->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return (new self())->jsonError($e);
        }
    }

    /**
     * @param StoreAvatarRequest $request
     * @return JsonResponse
     */
    public static function storeAvatar(StoreAvatarRequest $request): JsonResponse
    {
        try {
            if ($request->file('file')) {
                $now = Carbon::now();
                $image = $request->file('file');
                $folderCreate = "/uploads/avatars/$now->year/$now->month/$now->day";
                $diskLocal = Storage::disk();
                $fileName = $diskLocal->put($folderCreate, $image);
                // Remove file old
                $fileOld = $request->get('fileOld', '');
                if ($fileOld) {
                    if (file_exists(public_path($fileOld))) {
                        unlink(public_path($fileOld));
                    } else {
                        return (new self())->jsonMessage(trans('error.file_not_found'), false, 500);
                    }
                }

                return (new self())->jsonData($diskLocal->url($fileName));
            }

            return (new self())->jsonMessage(trans('error.file_not_found'), false, 500);
        } catch (\Exception $e) {
            return (new self())->jsonError($e);
        }
    }
}
