# life
So this is my attempt at a "pure" PHP implementation of Life. This was an exercise that just took way too long. (Roughly a month or about 20 hours)

Some of the things I'd like to have implemented:

-A way to save setups so that you don't have to manually input each time (I really wish I had time to do this, but I feel it's outside the scope of just an exercise. Maybe some day...)

-Removing all Javascript and have it be purely PHP.  (I tried implementing it directly in PHP but when I change the header to refresh, it gives an error. I remember faintly about how in order to get around this, I'd have to ob_start() which is apparently bad practice so I decided to leave it in.)

-Doing it without $_SESSION. (This is more about vanity and wanting to work some more with JSON.)

-Allow the user to dynamically specify the size of the life area. (The area I've specified is very small because I'm on an older laptop that has a limited resolution.)

I am realy glad to have worked on this though. More than a decade ago, I remember reading Steven Levy's Hackers and how he devoted huge swaths to The Game Of Life. Even after giving a basic run through on my computer, I still didn't understand what the big deal was. But putting it in the context of the computing limitations of the 70s and my own personal experience now with developing a basic implementation, it makes a lot more sense. 
