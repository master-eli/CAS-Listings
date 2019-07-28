
<div class="side-nav d-print-none">
	<ul class="list-unstyled">
		<li style="margin-top: 15px"> <h4> Departments </h4> </li>
		<li> <ul class="list-unstyled submenu">
			<li> <a href="/listings"> Listings </a> </li>
			@cannot('isAdmin')
			<li><a id="btn-add">Add</a></li>
			@endcan
			<li> <a href="/condemn">Condemn</a> </li>
			@can('isAdmin')
				<li> <a href="/addDept"> Add Department </a> </li>
			@endcan
		</ul> </li>
	</ul>
</div>