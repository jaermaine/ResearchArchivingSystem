@php
    // Extract the user data from the passed variable
    // Default to empty if not passed
    $user = $user ?? null;
    
    // Generate avatar URL
    if ($user && $user->profile_picture) {
        $imageUrl = asset('storage/profile_pictures/' . $user->profile_picture);
    } elseif ($user) {
        $imageUrl = 'https://ui-avatars.com/api/?name='.urlencode($user->first_name.' '.$user->last_name).'&background=800000&color=ffffff&size=150';
    } else {
        $imageUrl = 'https://ui-avatars.com/api/?name=User&background=800000&color=ffffff&size=150';
    }
@endphp

<div class="flex flex-col items-center justify-center w-full h-full">
    <div class="relative w-full pt-[100%]">
        <img 
            src="{{ $imageUrl }}"
            alt="User profile image"
            class="absolute inset-0 w-full h-full rounded-full shadow-md object-cover"
            onerror="this.src='https://ui-avatars.com/api/?name=User&background=800000&color=ffffff&size=150'">
    </div>
</div>