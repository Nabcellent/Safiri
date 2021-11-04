let primary = localStorage.getItem("primary") || '#24695c';
let secondary = localStorage.getItem("secondary") || '#ba895d';

window.vihoAdminConfig = {
	// Theme Primary Color
	primary: primary,
	// theme secondary color
	secondary: secondary,
};

// default layout
$("#default-demo").on('click', function(){
    localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper');
    localStorage.setItem('page-body-wrapper', 'sidebar-icon');
});

// compact layout
$("#compact-demo").on('click', function(){
    localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper compact-sidebar');
    localStorage.setItem('page-body-wrapper', 'sidebar-icon');
});

// modern layout
$("#modern-demo").on('click', function(){
    localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper modern-sidebar');
    localStorage.setItem('page-body-wrapper', 'sidebar-icon');
});
