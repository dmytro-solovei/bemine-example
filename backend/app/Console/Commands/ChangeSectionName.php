<?php

namespace App\Console\Commands;

use App\Models\Section;
use Illuminate\Console\Command;

class ChangeSectionName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'section:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sections = Section::all();

        foreach ($sections as $section) {
            $section->name = [
                'en' => $section->name,
                'ru' => '',
                'am' => '',
            ];
            $section->save();
        }
    }
}
