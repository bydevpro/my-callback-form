@auth
@include('header')



<link rel="stylesheet" href='css/form.css'/>
    <h2>Форма обратной связи</h2>
    <form action="{{ route('user.callback.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="subject">Тема обращения:</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required />
            @error('subject')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message">Текст обращения:</label>
            <textarea name="message" id="message" rows="10" required>{{ old('message') }}</textarea>
            @error('message')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="attachment">Файл:</label>
            <input type="file" name="attachment" id="attachment" max="3000000" accept="image/*,video/*,.pdf,.doc,.docx" required />
            @error('attachment')
                <p class="error-message">{{ $message }}</p>
            @enderror
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        </div>

        <div>
            <button type="submit">Отправить</button>
        </div>
    </form>
    @else
    <div class="card" style="width: 18rem; margin-top:25%; margin-left:40%;box-shadow: 10px 10px 8px #888888;">
  <div class="card-body">
    <h5 class="card-title">Пожалуйста, авторизируйтесь</h5>
    <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('user.login') }}">Войти</a>
</div>

@endauth
@include('footer')