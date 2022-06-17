<?php

namespace App\Http\Controllers;

use App\Models\Bincode;
use Illuminate\Http\Request;

class BincodeController extends Controller
{
    public function generate(Request $request)
    {
        $this->validate($request, ['bincount' => 'nullable|numeric']);

        $bincount = 1;

        if ($request->bincount) {
            $bincount = $request->bincount;
        }

        $bincodes = [];

        for ($i = 0; $i < $bincount; $i++) {
            $bincode = $this->generateBincode();

            Bincode::create(['bincode' => $bincode]);

            $bincodes[] = $bincode;
        }

        return response()->Json([$bincodes]);
    }

    /**
     * generate unique sigle bincode
     * if stored bincodes reached maximum possibility then return duplicated
     * 
     * @return string
     */
    public function generateBincode(): string
    {
        while (true) {
            $bincode = rand(1000, 9998);

            $bincode_count = Bincode::count();

            $bincodes_unwanted_patterns = ['1111', '2222', '3333', '4444', '5555', '6666', '7777', '8888'];

            if ($bincode_count == 8990 && ! in_array($bincode, $bincodes_unwanted_patterns)) {
                return $bincode;
            }

            $bincode_exists = Bincode::where('bincode', $bincode)
                ->first();

            if (! $bincode_exists && ! in_array($bincode, $bincodes_unwanted_patterns)) {
                return $bincode;
            }
        }
    }
}
