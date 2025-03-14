<x-lowlayout>
    <x-slot:head>
        <title>Tag Management</title>
    </x-slot:head>
    <h2>Tag Management</h2>

    <button>Create Tag</button>
    <?php
    foreach($tags as $tag)
    {
        ?>
        <div>
        <p>{{$tag["Name"]}}</p>
        </div>
        <?php
    }
    ?>
</x-lowlayout>