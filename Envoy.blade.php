@servers(['online'=>'120.77.71.171'])

@task('foo',['on'=>'local'])
    ls -la
@endtask