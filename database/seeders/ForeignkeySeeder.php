<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignkeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//regions
		Schema::table('regions', function (Blueprint $table) {
            $table->foreign('archive')->references('archive_id')->on('archives');	
        });
		//objects
		Schema::table('trucks', function (Blueprint $table) {
            $table->foreign('region')->references('region_id')->on('regions');	
        });
		//updates
		Schema::table('updates', function (Blueprint $table) {
            $table->foreign('truck')->references('truck_id')->on('trucks');	
        });
    }
}
