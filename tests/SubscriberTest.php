<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Model\User;
use Model\Subscriber;
use Src\Request;
use Controller\SubscriberController;

class SubscriberTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        Subscriber::whereHas('user', function($q) {
            $q->where('login', 'like', 'test_%');
        })->delete();

        User::where('login', 'like', 'test_%')->delete();
    }

    public function testAddValidSubscriber()
    {
        $testUser = User::create([
            'login' => 'test_user_' . time(),
            'password' => md5('password'),
            'role' => 'sysadmin'
        ]);

        $request = $this->createMock(Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn([
                'surname' => 'Иванов',
                'name' => 'Иван',
                'patronymic' => 'Петрович',
                'birth_date' => '1990-01-01',
                'user_id' => $testUser->id
            ]);

        (new SubscriberController())->add($request);
        $this->assertEquals(1, Subscriber::whereHas('user', function($q) use ($testUser) {
            $q->where('id', $testUser->id);
        })->count());
    }

    public function testAddSubscriberWithInvalidData()
    {
        $testUser = User::create([
            'login' => 'test_user_' . time(),
            'password' => md5('password'),
            'role' => 'sysadmin'
        ]);

        $request = $this->createMock(Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn([
                'surname' => 'Invalid123',
                'name' => 'Test',
                'patronymic' => '123',
                'birth_date' => '2025-01-01',
                'user_id' => $testUser->id
            ]);

        $result = (new SubscriberController())->add($request);
        $content = $result->getContent();

        $this->assertTrue(strpos($content, 'кириллические символы') !== false);
        $this->assertTrue(strpos($content, '18 лет') !== false);
    }

    public function testViewSubscriberPhones()
    {
        $testUser = User::create([
            'login' => 'test_user_' . time(),
            'password' => md5('password'),
            'role' => 'sysadmin'
        ]);

        $subscriber = Subscriber::create([
            'surname' => 'Тестов',
            'name' => 'Тест',
            'patronymic' => 'Тестович',
            'birth_date' => '1980-01-01',
            'user_id' => $testUser->id
        ]);

        $request = $this->createMock(Request::class);
        $request->method = 'GET';

        $result = (new SubscriberController())->viewPhones($request, $subscriber->id);
        $this->assertTrue(strpos($result->getContent(), 'Тестов Тест Тестович') !== false);
    }
}