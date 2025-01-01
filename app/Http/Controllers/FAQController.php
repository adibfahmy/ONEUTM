<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        // Retrieve all FAQs
        $faqs = FAQ::all();
        
        // Pass the FAQs to the view
        return view('faqindex', compact('faqs'));
    }
}