<?php

namespace App\Console\Commands;

use App\Console\Commands\AbstractCommand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\AdminRepositoryInterface;

class CreateAdminCommand extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createAdmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '管理者ユーザーを作成する';

    /**
     * @var AdminRepositoryInterface
     */
    private $admin;
    /**
     * バリデーションルール
     *
     * @var array
     */
    private $rules;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AdminRepositoryInterface $admin)
    {
        parent::__construct();
        $this->admin = $admin;

        $this->rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->start();
        $this->info('管理者ユーザーを作成します');

        $name = $this->ask('名前を入力して下さい');
        $email = $this->ask('メールアドレスを入力して下さい');
        $password = $this->ask('パスワードを入力して下さい');
        $password_confirmation = $this->ask('もう一度パスワードを入力して下さい');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ];

        if (!$this->validate($data)) {
            exit();
        }

        $this->info("名前：$name");
        $this->info("メールアドレス：$email");
        $this->info("パスワード：$password");

        if ($this->confirm('この内容で登録してもよろしいですか？')) {
            $data['password'] = Hash::make($data['password']);
            $this->admin->create($data);
            $this->info('登録が完了しました');
        } else {
            $this->info('キャンセルしました');
        }
        $this->end();
    }

    /**
    * バリデート
    *
    * @param array $data
    * @return bool
    */
    private function validate(array $data): bool
    {
        // バリデーション
        $validator = Validator::make(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation']
            ],
            $this->rules
        );

        if ($validator->fails()) {
            $this->info('See error messages below:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }
        return true;
    }
}
