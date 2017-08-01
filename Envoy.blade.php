@servers(['online'=>'120.77.71.171'])

@task('deploy',['on'=>'online'])
    php artisan init:file
@endtask