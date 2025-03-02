<div>
    <form method="POST" action="/logout" id="logoutForm">
    @csrf
        <select id="dropdown" onchange="handleDropdownChange()" class="outline-none focus:ring-0 w-full h-[50px] px-4 rounded-lg">
            <option value="" selected hidden>Menu</option>
            <option value="welcome">Home</option>
            <hr>
            <option value="dashboard">My Documents</option>
            <option value="settings">Profile Settings</option>
            <hr>
            <option value="logout">Log out</option>
        </select>
        <button type="submit" id="logoutButton" style="display: none;">Log out</button>
    </form>
</div>

<script>
    function handleDropdownChange() {
        var selectedOption = document.getElementById('dropdown').value;

        if (selectedOption === 'welcome') {
            window.location.href = '/welcome';
        }else if (selectedOption === 'dashboard') {
            window.location.href = '/dashboard';
        } else if (selectedOption === 'settings') {
            window.location.href = '/settings';
        } else if (selectedOption === 'logout') {
            document.getElementById('logoutButton').click();
        }
    }
</script>