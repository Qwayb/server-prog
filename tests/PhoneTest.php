<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Model\Phone;
use Model\Room;
use Model\Subscriber;
use Model\User;
use Src\Request;
use Controller\PhoneController;

class PhoneTest extends TestCase
{
    protected function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        Phone::where('number', 'like', 'test_%')->delete();
        Subscriber::whereHas('user', function($q) {
            $q->where('login', 'like', 'test_%');
        })->delete();
        User::where('login', 'like', 'test_%')->delete();
    }

    public function testAttachPhoneToSubscriber()
    {
        $testUser = User::create([
            'login' => 'test_user_' . time(),
            'password' => md5('password'),
            'role' => 'admin'
        ]);

        $subscriber = Subscriber::create([
            'surname' => 'Тестов',
            'name' => 'Тест',
            'patronymic' => 'Тестович',
            'birth_date' => '1980-01-01',
            'user_id' => $testUser->id
        ]);

        $room = Room::firstOrCreate(['title' => 'Test Room']);

        $phone = Phone::create([
            'number' => 'test_' . time(),
            'room_id' => $room->id
        ]);

        $request = $this->createMock(Request::class);
        $request->method = 'POST';
        $request->expects($this->any())
            ->method('all')
            ->willReturn(['subscriber_id' => $subscriber->id]);

        (new PhoneController())->attachSubscriber($phone->id, $request);
        $this->assertEquals($subscriber->id, Phone::find($phone->id)->subscriber_id);
    }

    public function testListPhones()
    {
        $room = Room::firstOrCreate(['title' => 'Test Room']);
        Phone::create([
            'number' => 'test_' . time(),
            'room_id' => $room->id
        ]);

        $request = $this->createMock(Request::class);
        $request->method = 'GET';

        $result = (new PhoneController())->list($request);
        $content = $result->getContent();
        $this->assertTrue(strpos($content, 'test_') !== false);
    }
}