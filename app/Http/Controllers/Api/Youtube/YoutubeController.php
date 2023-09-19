<?php

namespace App\Http\Controllers\Api\Youtube;

use App\Http\Controllers\Controller;
use App\Models\YoutubeChannel;
use App\Models\YoutubeChannelVideo;
use App\Transformers\Users\YoutubeChannelTransformer;
use App\Transformers\Users\YoutubeChannelVideoTransformer;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{

    public function show(Request $request, $name)
    {

        try {

        // Search for a YouTube channel by name
        $channel = YoutubeChannel::where('channel_name', $name)->first();
    
        if (!$channel) {
            return response()->json(['message' => 'YouTube channel not found'], 404);
        }
    
        // Retrieve associated videos
        $videos = $channel->videos;
    
        return response()->json([
            'channel' => $channel,
            'videos' => $videos,
        ]);

        }  catch (\Exception $e) {
            error_log('Error: ' . $e->getMessage());
            // Handle any exceptions that may occur during the process
            return response()->json(['error' => $e->getMessage()], 500);
        }
       
    }
    


public function store(Request $request)
{
    try {
        // Get JSON data from the request body
        $jsonData = $request->json()->all();

        // Extract channel info from JSON data
        $channelInfo = $jsonData['channel_info'];
        $videos = $jsonData['videos'];

        // Create a new YoutubeChannel instance and populate it with data
        $channel = new YoutubeChannel([
            'channel_id' => $channelInfo['id'],
            'channel_name' => $channelInfo['snippet']['title'],
            'channel_description' => $channelInfo['snippet']['description'],
            'channel_profile_picture' => $channelInfo['snippet']['thumbnails']['default']['url'],
            'uuid' => $channelInfo['id'], // Assuming 'uuid' is the channel's ID
        ]);

        // Save the channel to the database
        $channel->save();


        foreach ($videos as $videoData) {
            try {
                // Create a new YoutubeChannelVideo instance and populate it with data
                $video = new YoutubeChannelVideo([
                    'uuid' => $videoData['id']['videoId'],
                    'link' => 'https://www.youtube.com/watch?v=' . $videoData['id']['videoId'],
                    'title' => $videoData['snippet']['title'],
                    'description' => $videoData['snippet']['description'],
                    'thumbnail' => $videoData['snippet']['thumbnails']['default']['url'],
                    
                ]);
        
                // Set the youtube_channel_id based on the specific channel you want to associate with
                $video->youtube_channel_id = $channel->id;

                // Save the video to the database
                $channel->videos()->save($video);
            } catch (\Exception $e) {
                error_log('Error: ' . $e->getMessage());
                // Handle any exceptions that may occur during the process
                // You can log the error or return an error response for debugging
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }


        // Return a JSON response to confirm channel data saving
        return response()->json(['message' => 'Channel data saved successfully']);
    } catch (\Exception $e) {

        error_log('Error: ' . $e->getMessage());
        // Handle any exceptions that may occur during the process
        return response()->json(['error' => $e->getMessage()], 500);
    }
}







}