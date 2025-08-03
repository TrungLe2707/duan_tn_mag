<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reviews;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminReviewController extends Controller
{
    public function index()
    {
        Carbon::setLocale('vi');

        $reviews = reviews::with(['user', 'product.thumbnail', 'children.user'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'user' => $review->user,
                    'comment' => $review->comment,
                    'rating' => $review->rating,
                    'product_id' => $review->product_id,
                    'product' => $review->product, // <-- truyền vào luôn
                    'created_at' => $review->created_at->timezone('Asia/Ho_Chi_Minh')->diffForHumans(),
                    'is_admin' => $review->user->role === 'admin',

                    'replies' => $review->children->map(function ($reply) {
                        return [
                            'id' => $reply->id,
                            'user' => $reply->user,
                            'comment' => $reply->comment,
                            'created_at' => $reply->created_at->timezone('Asia/Ho_Chi_Minh')->diffForHumans(),
                            'is_admin' => $reply->user->role === 'admin',
                            'product_id' => $reply->product_id,
                        ];
                    }),
                ];
            });

        return view('admin.comments', ['reviews' => $reviews]);
    }

    public function replyComments(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'parent_id' => 'required|exists:reviews,id',
            'reply' => 'required|string|max:1000',
        ]);

        reviews::create([
            'user_id' => 10,
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id,
            'comment' => $request->reply,
            'rating' => null,
        ]);

        return redirect()->back()->with('success', 'Phản hồi đã được gửi thành công!');
    }
  public function destroy(Request $request)
{
    $comment = Reviews::find($request->id);

    if (!$comment) {
        return redirect()->back()->with('error', 'Bình luận không tồn tại!');
    }

    // Nếu là bình luận cha (không có parent_id), xóa cả phản hồi con
    if ($comment->parent_id === null) {
        Reviews::where('parent_id', $comment->id)->delete();
        $comment->delete();
        return redirect()->back()->with('success', 'Đã xóa bình luận và tất cả phản hồi liên quan.');
    }

    // Nếu là bình luận con (phản hồi), chỉ xóa bản thân
    $comment->delete();
    return redirect()->back()->with('success', 'Đã xóa phản hồi thành công!');
}


} 
