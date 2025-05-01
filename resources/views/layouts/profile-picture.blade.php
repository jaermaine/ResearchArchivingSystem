@php
    $user = (object) $user;

    $profile_picture = $user->profile_picture ?? null;

    Log::info('User Profile Picture:', ['profile_picture' => $profile_picture]);
    
    // Get user name for avatar
    $userName = '';
    if ($user && isset($user->first_name) && isset($user->last_name)) {
        $userName = $user->first_name . ' ' . $user->last_name;
    }

    // Generate avatar URL
    if ($user && !empty($user->profile_picture)) {
        Log::info('Profile picture found:', ['profile_picture' => $user->profile_picture]);
        $imageUrl = asset('storage/profile_pictures/' . $user->profile_picture);
    } else {
        Log::info('No profile picture found, using avatar:', ['userName' => $userName]);
        $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=800000&color=ffffff&size=150';
    }
@endphp

<div class="flex flex-col items-center justify-center w-full h-full">
    <div class="relative w-full pt-[100%]">
        <img 
            src="{{ $imageUrl }}"
            alt="User profile image"
            title="{{ $user->first_name ?? 'User' }} {{ $user->last_name ?? 'User' }}"
            class="absolute inset-0 w-full h-full rounded-full shadow-md object-cover"
            onerror="this.src='https://ui-avatars.com/api/?name=User&background=800000&color=ffffff&size=150'">
    </div>
</div>