const showTab = (elTabBtn) => {
    const elTab = elTabBtn.closest('.content');
    if (elTabBtn.classList.contains('link-active')) {
        return;
    }
    const targetId = elTabBtn.dataset.targetId;
    const elTabPane = elTab.querySelector(`.link-pane[data-id="${targetId}"]`);
    if (elTabPane) {
        const elTabBtnActive = elTab.querySelector('.link-active'); // Fix here
        const elTabPaneShow = elTab.querySelector('.link-pane-show');
        elTabBtnActive.classList.remove('link-active'); // Update the active class here
        elTabPaneShow.classList.remove('link-pane-show');
        elTabBtn.classList.add('link-active');
        elTabPane.classList.add('link-pane-show');
    }
}

document.addEventListener('click', (e) => {
    if (e.target && !e.target.closest('.content__panel-link')) {
        return;
    }
    const elTabBtn = e.target.closest('.content__panel-link');
    showTab(elTabBtn);
});
