<?php
use PHPUnit\Framework\TestCase;
use Src\Request;
use Controller\Site;
use Model\User;
use Model\Subscriber;
use Model\Phone;

class SiteTest extends TestCase
{
    /**
     * Настройка окружения для каждого теста.
     * Повторяет пример из методички, но через phpunit.xml
     * это выполняется один раз в bootstrap.php – остаётся
     * только очистить БД после каждого теста, если нужно.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /* -------------------------------------------------
     *  ТЕСТЫ РЕГИСТРАЦИИ
     * -------------------------------------------------*/

    /**
     * @dataProvider signupProvider
     * @runInSeparateProcess
     */
    public function testSignup(string $httpMethod, array $userData, string $expect): void
    {
        // если нужно «занятый» логин – берём первый попавшийся из БД
        if ($userData['login'] === 'login_is_busy') {
            $userData['login'] = User::first()->login;
        }

        // Заглушка Request
        $request = $this->createMock(Request::class);
        $request->method = $httpMethod;
        $request->method('all')->willReturn($userData);

        $result = (new Site())->signup($request);

        // 1-й и 2-й кейсы – ошибки валидации → во View печатается <h3>…</h3>
        if (!empty($result)) {
            $this->expectOutputRegex('/' . preg_quote($expect, '/') . '/');
            return;
        }

        // 3-й кейс – успешная регистрация → запись появилась
        $this->assertTrue(
            (bool) User::where('login', $userData['login'])->count()
        );
        // подчистим БД
        User::where('login', $userData['login'])->delete();

        // редирект
        $this->assertContains($expect, xdebug_get_headers());
    }

    public function signupProvider(): array
    {
        return [
            // GET – пустая форма
            ['GET',  ['name'=>'',  'login'=>'',           'password'=>''], '<h3></h3>'],

            // POST – пустые данные
            ['POST', ['name'=>'',  'login'=>'',           'password'=>''], '<h3>{"name":["Поле name пусто"],"login":["Поле login пусто"],"password":["Поле password пусто"]}</h3>'],

            // POST – занятый логин
            ['POST', ['name'=>'Тест', 'login'=>'login_is_busy','password'=>'secret'], '<h3>{"login":["Поле login должно быть уникально"]}</h3>'],

            // POST – успех
            ['POST', ['name'=>'Тест', 'login'=>md5(time()),  'password'=>'secret'], 'Location: /login']
        ];
    }

    /* -------------------------------------------------
     *  ТЕСТЫ АВТОРИЗАЦИИ
     * -------------------------------------------------*/

    /**
     * @dataProvider loginProvider
     * @runInSeparateProcess
     */
    public function testLogin(string $httpMethod, array $credentials, string $expect): void
    {
        // гарантируем, что есть хотя бы один пользователь
        $user = User::first() ?: User::create([
            'name'     => 'root',
            'login'    => 'root',
            'password' => password_hash('root', PASSWORD_BCRYPT)
        ]);

        if ($credentials['login'] === 'valid') {
            $credentials['login']    = $user->login;
            $credentials['password'] = 'root';
        }

        $request = $this->createMock(Request::class);
        $request->method = $httpMethod;
        $request->method('all')->willReturn($credentials);

        $result = (new Site())->login($request);

        if (!empty($result)) {
            // ошибки авторизации печатаются в <h3>…</h3>
            $this->expectOutputRegex('/' . preg_quote($expect, '/') . '/');
            return;
        }

        // при успешном входе получаем редирект
        $this->assertContains($expect, xdebug_get_headers());
    }

    public function loginProvider(): array
    {
        return [
            // GET – страница входа
            ['GET',  ['login'=>'',          'password'=>''], '<h3></h3>'],
            // POST – неверные данные
            ['POST', ['login'=>'wrong',     'password'=>'x'], '<h3>{"login":["Неверный логин или пароль"]}</h3>'],

            // POST – верные данные
            ['POST', ['login'=>'valid',     'password'=>'root'], 'Location: /']
        ];
    }

    /* -------------------------------------------------
     *  ТЕСТ ВЫБРАННОЙ ФУНКЦИИ (пример: все телефоны абонента)
     * -------------------------------------------------*/

    public function testPhonesBySubscriber(): void
    {
        // создаём «тестового» абонента и 2 его номера
        $subscriber = Subscriber::create([
            'surname'    => 'Unit',
            'name'       => 'Test',
            'partonomic' => '',
            'birth_date' => '1990-01-01',
            'user_id'    => 1
        ]);

        $phoneA = Phone::create(['number'=>'100-01', 'room_id'=>1, 'subscriber_id'=>$subscriber->id]);
        $phoneB = Phone::create(['number'=>'100-02', 'room_id'=>1, 'subscriber_id'=>$subscriber->id]);

        // сама бизнес-функция
        $phones = Phone::bySubscriber($subscriber->id);   // предполагаемый скоуп/метод модели

        $this->assertCount(2, $phones);

        /* уборка */
        Phone::where('subscriber_id', $subscriber->id)->delete();
        $subscriber->delete();
    }
}