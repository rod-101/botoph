// auth.js
export async function checkSessionAndRedirect() {
    try {
        const response = await fetch('../api/fetch_user_session.php', { cache: 'no-store' });
        const data = await response.json();
        
        if (!data.isLoggedIn && data.redirect) {
            window.location.href = data.redirect;
        }
    } catch (error) {
        console.error('Failed to fetch session info:', error);
    }
}

export function authCheckOnPageRestore() {
    window.onpageshow = function (event) {
        if (event.persisted) {
            checkSessionAndRedirect();
        }
    };
}

export async function checkSessionAndRedirectForVoter() {
    try {
        const response = await fetch('../api/fetch_voter_session.php', { cache: 'no-store' });
        const data = await response.json();
        
        if (!data.isLoggedIn && data.redirect) {
            window.location.href = data.redirect;
        }
    } catch (error) {
        console.error('Failed to fetch session info:', error);
    }
}

export function authCheckOnPageRestoreForVoter() {
    window.onpageshow = function (event) {
        if (event.persisted) {
            checkSessionAndRedirectForVoter();
        }
    };
}