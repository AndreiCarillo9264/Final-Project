document.getElementById('logoutButton')?.addEventListener('click', async (e) => {
    e.preventDefault();
    try {
        const response = await fetch('../backend/api/logout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();
        if (result.success) {
            window.location.href = '../index.php';
        } else {
            throw new Error(result.error || 'Failed to log out.');
        }
    } catch (error) {
        console.error('Error during logout:', error);
        alert('An unexpected error occurred while logging out.');
    }
});