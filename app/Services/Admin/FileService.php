<?php

namespace app\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function create(Request $request)
    {
        if ($request->file('file_data') !== null) {
            $fileName = $this->addFile($request->file('file_data'));
            $request->merge([
                'file_name' => $fileName,
            ]);
        }
        return $request;
    }

    public function update(Request $request)
    {
        if ($request->file('file_data') !== null) {
            $this->removeFile($request->id);
            $fileName = $this->addFile($request->file('file_data'));
            $request->merge([
                'file_name' => $fileName,
            ]);
        }
        return $request;
    }

    public function removeFile($id)
    {
        $re = Product::findOrFail($id);
        Storage::delete(config('const.file_path') . $re->file_name);
        Storage::delete(config('const.thumbnail_path') . $re->file_name);
    }

    public function addFile($imagefile)
    {
        $now = date_format(Carbon::now(), 'YmdHis');
        $originalName = $imagefile->getClientOriginalName();
        $storePath = config('const.file_path');
        $fileName = $now . "_" . $originalName;
        Storage::putFileAs($storePath, $imagefile, $fileName);
        $image = Image::make($imagefile)
            ->resize(320, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        $storePath = config('const.thumbnail_path') . $fileName;
        Storage::put($storePath, (string) $image->encode());
        return $fileName;

        // 	$file_name = $request->file('image')->getClientOriginalName();
        // 	$filename = pathinfo($file_name, PATHINFO_FILENAME); //ファイル名のみ
        // 	$extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子のみ
        // 	$file_name = $filename . date("_YmdHis") . '.' . $extension;
    }
}
