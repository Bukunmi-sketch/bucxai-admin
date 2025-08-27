<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class NoticeBoard extends Component
{
    public $title;
    public $description;
    public $published_by;
    public $visible_for;
    public $notices;
    public $selectedNotice = null;

    // For showing the modal
    public $showModal = false;
     // For deletion confirmation modal
     public $confirmingNoticeDeletion = false;
     public $selectedNoticeId;

       // For notice details modal
    public $viewingNoticeDetails = false;



    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'visible_for' => 'required|in:all,agents,users,staffs,clients',
    ];

    public function mount()
    {
        $this->published_by = Auth::user()->name;
        $this->fetchNotices();
    }

    public function confirmDelete($noticeId)
    {
        $this->confirmingNoticeDeletion = true;
        $this->selectedNoticeId = $noticeId;
    }

    public function deleteNotice()
    {
        if ($this->selectedNoticeId) {
            $notice = Notice::find($this->selectedNoticeId);
            if ($notice) {
                $notice->delete();
            }

            $this->confirmingNoticeDeletion = false;
            $this->selectedNoticeId = null;

            $this->fetchNotices(); // Refresh the noticeboard
        }
    }

    public function fetchNotices()
    {
        $this->notices = Notice::orderBy('created_at', 'desc')->get();
    }

    public function createNotice()
    {
        $this->validate();

        Notice::create([
            'title' => $this->title,
            'description' => $this->description,
            'published_by' => $this->published_by,
            'visible_for' => $this->visible_for,
        ]);

        // Reset input fields and close modal
        $this->reset(['title', 'description', 'visible_for']);
        $this->showModal = false;
        $this->fetchNotices(); // Re-fetch notices to update the table
        session()->flash('message', 'Notice added successfully.');
    }

    public function viewDetails($noticeId)
    {
        $this->selectedNotice = Notice::find($noticeId);
        $this->viewingNoticeDetails = true;
    }

    public function render()
    {
        return view('livewire.notice-board');
    }
}

