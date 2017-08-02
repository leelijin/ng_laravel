@servers(['online'=>'120.77.71.171','local'=>'127.0.0.1'])

@task('deploy',['on'=>'local'])
    cd /home/wwwroot/ng_server
    php artisan init:file
@endtask