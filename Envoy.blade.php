@servers(['online'=>'120.77.71.171','local'=>'127.0.0.1:8000'])

@task('foo',['on'=>'local'])
    ls -la
@endtask