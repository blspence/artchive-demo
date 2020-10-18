<?php

namespace App\Http\Controllers;

use App\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Displays a view to show the FAQ page.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function show(FAQ $faq)
    {
        return view('faq.show', compact('faq'));
    }

    /**
     * Shows the form for editing the FAQ page.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function edit(FAQ $faq)
    {
        return view('faq.edit', compact('faq'));
    }

    /**
     * Updates the FAQ instance in the database.
     *
     * @todo impl this
     *
     * @param Request $request
     * @param FAQ $faq
     * @return Response
     */
    public function update(Request $request, FAQ $faq)
    {
        dd($faq);

        return redirect(route('faq.show', $faq));
    }

}
