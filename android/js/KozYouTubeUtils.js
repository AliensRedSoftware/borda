"use strict";

/**
 * @namespace KozYouTubeUtils
 * @desc Class consists of some useful methods for working with YouTube.
 * @author Kozalo <kozalo@yandex.ru>
 * @copyright Kozalo.Ru, 2016
 */
let KozYouTubeUtils = {

    /**
     * Parses received text and returns only the ID of the first found video. Returns false if found nothing.
     * @param {String} text
     * @returns {String|Boolean}
     * @throws KozExceptions.missingArgument, KozExceptions.invalidArgument, or their string equivalents.
     * @memberof KozYouTubeUtils
     */
    parseId: function(text) {
        if (typeof(KozUtils) !== "undefined")
            KozUtils.checkParameters(text, "string", "parseId", "text");


        let videoId = text.match(/http[s]?:\/\/(www.)?youtube.com\/watch\S*v=([\w\-]+)/i);
        if (videoId) {
            return videoId[2];
        }
        else {
            videoId = text.match(/http[s]?:\/\/youtu.be\/(\w+)/i);
            if (videoId)
                return videoId[1];
        }
    },


    /**
     * Converts duration from YouTube format into human-readable string: PT3M54S => 03:54
     * @param {String} duration
     * @returns {String}
     * @throws KozExceptions.missingArgument, KozExceptions.invalidArgument, or their string equivalents.
     * @memberof KozYouTubeUtils
     */
    durationToString: function(duration) {
        if (typeof(KozUtils) !== "undefined")
            KozUtils.checkParameters(duration, "string", "durationToString", "duration");


        let times = duration.match(/([0-9]{1,3})/g);
        let newTimes = [];

        for (let i = 0; i < times.length; i++)
        {
            if (times[i].length < 2)
                newTimes.push('0' + times[i]);
            else
                newTimes.push(times[i]);
        }

        return newTimes.join(':');
    }

};
