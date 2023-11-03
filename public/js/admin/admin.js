function loadScript(src, async = true) {
    const script = document.createElement('script');
    script.src = src;
    script.async = async;
    document.body.appendChild(script);
}

loadScript('/js/admin/content.js');
loadScript('/js/admin/users/users.js');
loadScript('/js/admin/users/delete.js');
loadScript('/js/admin/users/edit.js');
loadScript('/js/admin/users/save.js');
