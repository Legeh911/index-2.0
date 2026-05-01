const Auth = (() => {
  const SESSION_KEY = 'index2_user';

  return {
    currentUser: () => {
      try {
        const raw = localStorage.getItem(SESSION_KEY);
        return raw ? JSON.parse(raw) : null;
      } catch { return null; }
    },
    logout: () => {
      window.location.href = 'logout.php';
    }
  };
})();