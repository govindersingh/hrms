<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $pageTitle = __('Profile');
        $files = Storage::files("documents/$user->email");
        $fileData = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $folder = $user->email;
            $fileData[] = [
                'name' => $fileName,
                'folder' => $folder,
            ];
        }
        return view('pages.profile', compact(
            'user',
            'pageTitle',
            'fileData'
        ));
    }

    public function edit(Request $request)
    {
        $user = auth()->user();
        return view('pages.profile.edit', compact(
            'user'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $user = User::findOrFail(auth()->user()->id);
        $imageName = $user->avatar;
        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user->update([
            'firstname' => $request->firstname ?? $user->firstname,
            'middlename' => $request->middlename ?? $user->middlename,
            'lastname' => $request->lastname ?? $user->lastname,
            //'email' => $request->email ?? $user->email,
            'username' => $request->username ?? $user->username,
            'address' => $request->address ?? $user->address,
            'country' => $request->country_name ?? $user->country,
            'country_code' => $request->country_code ?? $user->country_code,
            'dial_code' => $request->dial_code ?? $user->dial_code,
            'phone' => $request->phone ?? $user->phone,
            'avatar' => $imageName,
        ]);
        $notification = notify(__('Profile has been updated'));
        return redirect()->route('profile')->with($notification);
    }

    public function documents(Request $request){
        $user = auth()->user();
        return view('pages.profile.document', compact(
            'user'
        ));
    }

    public function saveDocuments(Request $request){
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(storage_path("app/documents/$request->folder"), $fileName);
            $notification = notify(__('Your document uploaded.'));
            return redirect()->route('profile')->with($notification);
        }else{
            $notification = notify(__('Something wrong.'));
            return redirect()->route('profile')->with($notification);
        }
    }

    public function downloadDocuments($folder, $file){
        $path = "documents/" . $folder . "/" . $file;

        // Check if the file exists in the storage
        if (!Storage::exists($path)) {
            return response()->json([
                "status" => false,
                "message" => "Document not found.",
                "path" => $path
            ], 404);
        }

        // Move the file to the public disk
        $publicPath = $path;
        Storage::disk('public')->put($publicPath, Storage::get($path));

        // Generate the download URL
        $downloadUrl = asset('storage/' . $publicPath);

        // Generate the delete URL
        $removeUrl = route('documents.delete', ['url' => urlencode($publicPath)]);

        // Optionally delete the public file after download
        // You can set a timeout here or rely on a cleanup cron job
        // Uncomment the next line if you want to delete immediately after moving
        // Storage::disk('public')->delete($publicPath);

        return response()->json([
            "status" => true,
            "message" => "File ready for download.",
            "download_url" => $downloadUrl,
            "remove_url" => $removeUrl
        ]);
    }

    public function deleteDocuments(Request $request){
        $decodedUrl = urldecode($request->query('url'));

        if (Storage::disk('public')->exists($decodedUrl)) {
            Storage::disk('public')->delete($decodedUrl);
            return response()->json([
                "status" => true,
                "message" => "File deleted successfully."
            ]);
        }

    }

}
