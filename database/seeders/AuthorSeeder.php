<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();
        DB::table('authors')->insert([
            [
                'surname' => 'Шевченко',
                'name' => 'Тарас',
                'middle_name' => 'Григорович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Гоголь',
                'name' => 'Микола',
                'middle_name' => 'Васильович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Нечуй-Левицький',
                'name' => 'Іван',
                'middle_name' => 'Семенович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Франко',
                'name' => 'Іван',
                'middle_name' => 'Якович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Гончар',
                'name' => 'Олесь',
                'middle_name' => 'Терентійович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Костенко',
                'name' => 'Ліна',
                'middle_name' => 'Василівна',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Стус',
                'name' => 'Василь',
                'middle_name' => 'Семенович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Українка',
                'name' => 'Леся',
                'middle_name' => null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'surname' => 'Котляревський',
                'name' => 'Іван',
                'middle_name' => 'Петрович',
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ]);
    }
}
