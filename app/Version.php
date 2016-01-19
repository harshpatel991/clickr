<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Utils;

class Version extends Model
{
    public function setVersionFromRequest($version, $game, Request $request) {
        $version->game_id = $game->id;
        $version->version = $request->version;
        $version->beta = $request->get('beta', false) == "true" ? true : false;
        $version->video_link = $request->video_link;

        if($request->hasFile('image1')) {
            $version->image1 = Utils::upload_image($request->file('image1'), $game->slug . '-' . $version->slug . '-1', $game->slug);
        } if($request->hasFile('image2')) {
            $version->image2 = Utils::upload_image($request->file('image2'), $game->slug . '-' . $version->slug . '-2', $game->slug);
        } if($request->hasFile('image3')) {
            $version->image3 = Utils::upload_image($request->file('image3'), $game->slug . '-' . $version->slug . '-3', $game->slug);
        } if($request->hasFile('image4')) {
            $version->image4 = Utils::upload_image($request->file('image4'), $game->slug . '-' . $version->slug . '-4', $game->slug);
        }

        $version->link_platform_pc = $request->has('link_platform_pc') ? $request->link_platform_pc : null;
        $version->link_platform_mac = $request->has('link_platform_mac') ? $request->link_platform_mac : null;
        $version->link_platform_ios = $request->has('link_platform_ios') ? $request->link_platform_ios : null;
        $version->link_platform_android = $request->has('link_platform_android') ? $request->link_platform_android : null;
        $version->link_platform_unity = $request->has('link_platform_unity') ? $request->link_platform_unity : null;
        $version->link_platform_other = $request->has('link_platform_other') ? $request->link_platform_other : null;

        $version->upcoming_features = $request->upcoming_features;
        $version->changes = $request->changes;
        return $version;
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
}
