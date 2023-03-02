@auth
@if(Auth::user()->getType()!='no')
@include('header')
@csrf

<link rel="stylesheet" href="css/style.css" />
<div class="container">
        <h3>Список заявок</h3>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
        <thead> <tr> <th class="nosort"><h3>Номер заявки</h3></th> 
        <th><h3>ID Пользователя</h3></th> 
        <th><h3>Имя пользователя</h3></th>
        <th><h3>Email</h3></th>
        <th><h3>Дата создания</h3></th> 
        <th><h3>Тема заявки</h3></th> 
        <th><h3>Заявка</h3></th> 
        <th><h3>Файл</h3></th> </tr> 
      </thead> 
      <tbody> 
       
      @foreach($data as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->user_id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->created_at }}</td>
        <td>{{ $item -> theme }}</td>
        <td>{{ $item -> message }}</td>
        <td><a href="/uploads/{{ $item->file }}">{{ $item -> file }}</a></td>
    </tr>
@endforeach


        </table>
        <div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
				<option value="10" selected="selected">10</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Кол-во строк на странице</span>
		</div>
		<div id="navigation">
			<img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Отображаемая страница <span id="currentpage"></span> из <span id="pagelimit"></span></div>
	</div>
    </div>
    <script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
var sorter = new TINY.table.sorter("sorter");
sorter.head = "head";
sorter.asc = "asc";
sorter.desc = "desc";
sorter.even = "evenrow";
sorter.odd = "oddrow";
sorter.evensel = "evenselected";
sorter.oddsel = "oddselected";
sorter.paginate = true;
sorter.currentid = "currentpage";
sorter.limitid = "pagelimit";
sorter.init("table",4);
</script>
@endif
@else
<div class="card" style="width: 18rem; margin-top:25%; margin-left:40%;box-shadow: 10px 10px 8px #888888;">
  <div class="card-body">
    <h5 class="card-title">Пожалуйста, авторизируйтесь</h5>
    <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('user.login') }}">Войти</a>
</div>


@endauth
@include('footer')