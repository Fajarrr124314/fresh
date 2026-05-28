<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan Model Product sudah dibuat
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ... function lainnya ...

    public function uploadImage(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'id' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // 2. Cari data produk di database jika ID diberikan dan bukan string "undefined"
        $product = null;
        if ($request->id && $request->id !== 'undefined') {
            $product = Product::find($request->id);
        }

        // 3. Proses Upload File
        if ($request->hasFile('image')) {
            // Hapus foto lama dari folder storage jika ada (hanya jika produk ada)
            if ($product && $product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan foto baru ke folder: public/storage/products
            $path = $request->file('image')->store('products', 'public');

            // 4. Update nama file di database (hanya jika produk ada)
            if ($product) {
                $product->image = $path;
                $product->save();
            }

            return response()->json([
                'success' => true,
                'image' => $path, // Kembalikan path untuk update tampilan di AlpineJS
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['success' => false], 400);
    }
}