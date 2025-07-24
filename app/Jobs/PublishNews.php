<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PublishNews implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $newsId;

    /**
     * Create a new job instance.
     */
    public function __construct($newsId)
    {
        $this->newsId = $newsId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        \Log::info("PublishNews job running for ID={$this->newsId}");
        $news = News::find($this->newsId);
        if (
            $news && $news->status === 'Chưa xuất bản'
            && $news->posted_date
            && $news->posted_date->lte(now())
        ) {
            $news->update(['status' => 'Đã xuất bản']);
            \Log::info("→ Updated status to Đã xuất bản for ID={$this->newsId}");
        }
    }
}
