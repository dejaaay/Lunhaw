<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tree;
use App\Models\Adoption;

class OrganizationInsightsController extends Controller
{
    public function index(Request $request)
    {
        $user = session('user');
        if (!$user || ($user['role'] ?? null) !== 'ngo') {
            return redirect('/login');
        }
        $orgId = $user['id'];
        $trees = Tree::where('user_id', $orgId)->get();
        $total = $trees->count();
        $adopted = Adoption::whereIn('tree_id', $trees->pluck('id'))->where('status', 'active')->count();
        return view('organization_insights', [
            'user' => $user,
            'total' => $total,
            'adopted' => $adopted,
        ]);
    }
}
