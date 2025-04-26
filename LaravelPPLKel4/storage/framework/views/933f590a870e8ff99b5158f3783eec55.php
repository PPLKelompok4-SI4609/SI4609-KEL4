<?php
    $article = $article ?? null;
?>

<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $article->title ?? '')); ?>" required>
</div>

<div class="mb-3">
    <label for="content" class="form-label">Konten</label>
    <textarea name="content" class="form-control" rows="5" required><?php echo e(old('content', $article->content ?? '')); ?></textarea>
</div>

<div class="mb-3">
    <label for="author" class="form-label">Penulis</label>
    <input type="text" name="author" class="form-control" value="<?php echo e(old('author', $article->author ?? '')); ?>">
</div>
<?php /**PATH D:\FloodPPL\AppFlood\LaravelPPLKel4\resources\views/admin/articles/form.blade.php ENDPATH**/ ?>