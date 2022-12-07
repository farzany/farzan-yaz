<div class="newsletter py-12 mt-12 border-y border-db flex flex-col w-full">
    <div class="flex justify-center items-center w-full">
        <img src="/storage/email-laptop.svg" class="w-40 mt-auto" alt="">
        <form method="POST" action="/newsletter" class="subscribe text-center flex flex-col items-center h-full w-fit max-w-full pr-4">
            @csrf

            <h2 class="text-2xl">Subscribe to get notified about new posts!</h2>
            <p class="font-work text-lg pb-3 pt-1">I promise to keep your inbox clean - only one a week.</p>
            <div class="relative w-96 max-w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                </div>
                <input type="text" name="email" id="email-address-icon email" class="w-full border text-lg rounded-lg focus:ring-blue-500 block pl-10 p-2.5 font-work bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="name@email.com">
            </div>
            @error('email')
                <span class="text-sm text-red-500 font-work w-full pt-2">{{ $message }}</span>
            @enderror
            <button type="submit" class="w-96 max-w-full text-white focus:ring-4 focus:outline-none font-work rounded-lg px-5 py-2.5 mt-2 text-center bg-blue-500 hover:bg-blue-600">Subscribe</button>
        </form>
    </div>
    <div class="newsletter pt-12 gap-5 flex justify-center items-center w-full text-center sm:text-left">
        <div class="g-ytsubscribe" data-channelid="UCvrcJLLb73nSfFRurmGUQuQ" data-layout="default" data-count="default"></div>
        <p class="text-lg font-work">More of a visual learner? Subscribe to my YouTube channel!</p>
    </div>
</div>