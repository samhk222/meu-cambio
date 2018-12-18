<?php

namespace App\Http\Controllers;

use App\Feed;
use App\News;
use Illuminate\Http\Request;
use Feeds;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Feed::all();

        foreach ($sources as $source) {
            $feed = Feeds::make($source->url);
            $data = array(
                'feed_id'   => \App\Feed::where('url',$feed->subscribe_url())->first()->id,
                'items'     => $feed->get_items(),
            );

            foreach ($data['items'] as $item) {
          
                \App\News::updateOrCreate(
                    [
                        'feeds_id'=> $data['feed_id'],
                        'title' => $item->get_title(),
                        'link' => $item->get_permalink(),
                        'description' => $item->get_description(),
                        'pubDate' => $item->get_date('Y-m-d H:i:s'),
                    ]
                );
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        //
    }
}
