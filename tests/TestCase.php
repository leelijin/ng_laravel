<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseTransactions;
    
    protected $params;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://ng_local';
    
    public function __construct()
    {
        $this->params=[
            'uid'=>3,
            'to_uid'=> mt_rand(4,70),
            'mobile'=>'18782967230',
            'password'=>123456,
            'star_id'=>800,
        ];
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    protected function base($uri,$params=[],array $dataStructure,$method='POST')
    {
        return $this->json($method,$uri,$params)
            ->seeJson(['error_code'=>0])
            ->seeJsonStructure(['data'=>$dataStructure]);
    }
}
