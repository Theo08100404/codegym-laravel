<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<!-- Bootstrapの定形コード… -->
<div class="card-body">
    <div class="card-title">
        本のタイトル
    </div>

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

    <!-- 本登録フォーム -->
    <form action="{{ url('books') }}" method="POST" class="form-horizontal">
        @csrf

        <!-- 本のタイトル -->
        <form enctype="multipart/form-data" action="{{ url('books') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input type="text" name="item_name" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="number" class="col-sm-3 control-label">数</label>
                    <input type="text" name="item_number" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" class="form-control">
                </div>
            </div>

            <div class="col-sm-6">
                <label>画像</label>
                <input type="file" name="item_img">
            </div>

            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
</div>
<!-- フラッシュメッセージの表示 -->
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<!-- Book: 既に登録されてる本のリスト -->
<!-- 現在の本 -->
@if (count($books) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table">
            <!-- テーブルヘッダ -->
            <thead>
                <th>本一覧</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <!-- 本タイトル -->
                    <td class="table-text">
                        <div>{{ $book->item_name }}</div>
                        <div> <img src="upload/{{$book->item_img}}" width="100"></div>
                    </td>
                    <!-- 本: 更新ボタン -->
                    <td>
                        <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                更新
                            </button>
                        </form>
                    </td>

                    <!-- 本: 削除ボタン -->
                    <td>
                        <form action="{{ url('book/'.$book->id) }}" method="POST">
                            @csrf
                            <!-- CSRFからの保護 -->
                            @method('DELETE')
                            <!-- 擬似フォームメソッド -->

                            <button type="submit" class="btn btn-danger">
                                削除
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-4 offset-md-4">
        {{ $books->links()}}
    </div>
</div>
@endif
@endsection
