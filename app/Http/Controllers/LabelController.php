<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    public function index(Request $request) {
        $type = $request->type ?? 'kayu';
        
        if ($type === 'a3-led') {
            return Product::where('user_id', Auth::id())
                          ->where('type', 'a3-led')
                          ->latest()
                          ->get();
        }

        return Label::where('user_id', Auth::id())->latest()->get();
    }

    public function store(Request $request) {
        $user = Auth::user();
        $type = $request->input('type', 'kayu');

        // Validasi data masuk
        $request->validate([
            'items' => 'required|array'
        ]);

        if ($type === 'a3-led') {
            // Hapus data lama A3 milik user ini
            $user->products()->where('type', 'a3-led')->delete();

            foreach ($request->items as $item) {
                $user->products()->create([
                    'name'             => $item['name'] ?? '',
                    'sub'              => $item['sub'] ?? '',
                    'benefit'          => $item['benefit'] ?? '',
                    'image'            => $item['image'] ?? '',
                    'old_price'        => $item['oldPrice'] ?? '0.000',
                    'new_price'        => $item['newPrice'] ?? '0.000',
                    'non_member_price' => $item['nonMemberPrice'] ?? '0.000',
                    'is_member'        => $item['isMember'] ?? false,
                    'type'             => 'a3-led',
                ]);
            }
        } else {
            // Hapus data lama Label milik user ini
            $user->labels()->delete();

            foreach ($request->items as $item) {
                $user->labels()->create([
                    'header'         => $item['header'] ?? 'HARGA HERAN',
                    'name'           => $item['name'] ?? '',
                    'sub'            => $item['sub'] ?? '',
                    'period'         => $item['period'] ?? '',
                    'oldPrice'       => $item['oldPrice'] ?? '0.000',
                    'newPrice'       => $item['newPrice'] ?? '0.000',
                    'nonMemberPrice' => $item['nonMemberPrice'] ?? '0.000',
                    'unit'           => $item['unit'] ?? 'PER 100 GR',
                    'isMember'       => $item['isMember'] ?? false,
                ]);
            }
        }

        return response()->json(['message' => 'Data berhasil disimpan ke cloud!']);
    }

    public function saveSingle(Request $request) {
        $user = Auth::user();
        $type = $request->input('type', 'kayu');
        $item = $request->input('item');

        if ($type === 'a3-led') {
            $data = [
                'name'             => $item['name'] ?? '',
                'sub'              => $item['sub'] ?? '',
                'benefit'          => $item['benefit'] ?? '',
                'image'            => $item['image'] ?? '',
                'old_price'        => $item['oldPrice'] ?? '0.000',
                'new_price'        => $item['newPrice'] ?? '0.000',
                'non_member_price' => $item['nonMemberPrice'] ?? '0.000',
                'is_member'        => $item['isMember'] ?? false,
                'type'             => 'a3-led',
                'user_id'          => $user->id,
            ];

            if (isset($item['id']) && $item['id']) {
                $product = Product::where('user_id', $user->id)->find($item['id']);
                if ($product) {
                    $product->update($data);
                    return response()->json(['message' => 'Item diperbarui!', 'item' => $product]);
                }
            }
            
            $newProduct = Product::create($data);
            return response()->json(['message' => 'Item disimpan!', 'item' => $newProduct]);
        } else {
            $data = [
                'header'         => $item['header'] ?? 'HARGA HERAN',
                'name'           => $item['name'] ?? '',
                'sub'            => $item['sub'] ?? '',
                'period'         => $item['period'] ?? '',
                'oldPrice'       => $item['oldPrice'] ?? '0.000',
                'newPrice'       => $item['newPrice'] ?? '0.000',
                'nonMemberPrice' => $item['nonMemberPrice'] ?? '0.000',
                'unit'           => $item['unit'] ?? 'PER 100 GR',
                'isMember'       => $item['isMember'] ?? false,
                'user_id'        => $user->id,
            ];

            if (isset($item['id']) && $item['id']) {
                $label = Label::where('user_id', $user->id)->find($item['id']);
                if ($label) {
                    $label->update($data);
                    return response()->json(['message' => 'Label diperbarui!', 'item' => $label]);
                }
            }

            $newLabel = Label::create($data);
            return response()->json(['message' => 'Label disimpan!', 'item' => $newLabel]);
        }
    }

    public function destroy(Request $request, $id) {
        $user = Auth::user();
        // Cek type dari input body atau query parameter (untuk kompatibilitas hosting)
        $type = $request->input('type') ?: $request->query('type', 'kayu');

        if ($type === 'a3-led') {
            Product::where('user_id', $user->id)->where('id', $id)->delete();
        } else {
            Label::where('user_id', $user->id)->where('id', $id)->delete();
        }

        return response()->json(['message' => 'Item dihapus dari database!']);
    }

    public function destroyAll(Request $request) {
        $user = Auth::user();
        $type = $request->input('type') ?: $request->query('type', 'kayu');

        if ($type === 'a3-led') {
            Product::where('user_id', $user->id)->where('type', 'a3-led')->delete();
        } else {
            Label::where('user_id', $user->id)->delete();
        }

        return response()->json(['message' => 'Semua data di cloud berhasil dihapus!']);
    }
}