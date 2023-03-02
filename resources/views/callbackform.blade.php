@auth
  <a href="/logout">Logout</a>
  <p>Hello, {{ Auth::user()->getName() }}</p>
@else
  <a href="/login">Login</a>
@endauth


    <h1>Форма обратной связи</h1>
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
