document.addEventListener('DOMContentLoaded', function () {
  const selectElement = document.getElementById('nav-tabs-mobile-js');
  const tabButtons = document.querySelectorAll('[data-bs-target]');

  selectElement.addEventListener('change', function () {
    const selectedTab = selectElement.value;
    const tabTrigger = document.querySelector(`button[data-bs-target="${selectedTab}"]`);
    if (tabTrigger) {
      new bootstrap.Tab(tabTrigger).show();
    }
  });

  tabButtons.forEach(button => {
    button.addEventListener('click', function () {
      const target = button.getAttribute('data-bs-target');
      const tabTrigger = document.querySelector(`button[data-bs-target="${target}"]`);
      if (tabTrigger) {
        new bootstrap.Tab(tabTrigger).show();
      }
    });
  });

  // Optional: Change the select dropdown when a tab is clicked
  document.querySelectorAll('#myTab button').forEach(button => {
    button.addEventListener('shown.bs.tab', function (e) {
      const target = e.target.getAttribute('data-bs-target'); // Get the data-bs-target attribute
      selectElement.value = target; // Set the select value
    });
  });
});

