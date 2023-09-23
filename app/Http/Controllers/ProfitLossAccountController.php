<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecondaryGroup;
use App\Models\PrimaryGroup;
use App\Models\JournalEntry;
use App\Models\PaymentVoucher;
use App\Models\JournalParticular;
use App\Models\ReceiptVoucher;
use App\Models\ContraVoucher;
use App\Models\ThemeSetting;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProfitLossAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web,agent');

    }


    public function index()
    {
        return view('admin.profit_loss.index');

    }

    public function filterType(Request $request)
    {
        $themeDetail = ThemeSetting::first();
        $companyDetail = CompanySetting::first();

        if(@$themeDetail->default_date_format=='nepali'){
            $pieces = explode("-", $request->input('date_from'));
            $pieces_second = explode("-", $request->input('date_to'));
            $from =$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0];
            $to =$pieces_second[2].' '.getNepaliMonth($pieces_second[1]).', '.$pieces_second[0];
        }elseif(@$themeDetail->default_date_format=='english'){
            $from = date('j F, Y',strtotime($request->input('date_from')));
            $to = date('j F, Y',strtotime($request->input('date_to')));
        }else{
            $from = date('j F, Y',strtotime($request->input('date_from')));
            $to = date('j F, Y',strtotime($request->input('date_to')));
        }

        /**
         *  Journal Entry,Receipt & Payment (Profit and Loss A/C)
         *
         */



         //receipt direct expenses
        $receipt_direct_expenses_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $receipt_direct_expenses_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


          //payment direct expenses
          $payment_direct_expenses_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('debit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                  });
              })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


          $payment_direct_expenses_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
                })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
                });
            })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal direct expenses
        $journal_direct_expenses_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_direct_expenses_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_direct_expenses    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct expenses');
        })
        ->select('id','name')->get();

        $journal_direct_expenses = getJournalProfitLossInfo($secondaryvalue_direct_expenses,$journal_direct_expenses_data,$receipt_direct_expenses_data,$payment_direct_expenses_data,$journal_direct_expenses_opening_data,$payment_direct_expenses_opening_data,$receipt_direct_expenses_opening_data);


          //receipt indirect expenses
          $receipt_indirect_expenses_data = ReceiptVoucher::with('receiptParticulars')
          ->whereHas('receiptParticulars',function($query){
              $query->whereHas('debit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                  });
              })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $receipt_indirect_expenses_opening_data = ReceiptVoucher::with('receiptParticulars')
          ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            })->orWhereHas('credit', function ($query) {
              $query->whereHas('primaryGroup', function ($query) {
                  $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
              });
          });
        })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

          //payment indirect expenses
          $payment_indirect_expenses_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('debit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                  });
              })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


          $payment_indirect_expenses_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            })->orWhereHas('credit', function ($query) {
              $query->whereHas('primaryGroup', function ($query) {
                  $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
              });
          });
        })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal indirect expenses
        $journal_indirect_expenses_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            });
        })

        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_indirect_expenses_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_indirect_expenses    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect expenses');
        })
        ->select('id','name')->get();

        $journal_indirect_expenses = getJournalProfitLossInfo($secondaryvalue_indirect_expenses,$journal_indirect_expenses_data,$receipt_indirect_expenses_data,$payment_indirect_expenses_data,$journal_indirect_expenses_opening_data,$payment_indirect_expenses_opening_data,$receipt_indirect_expenses_opening_data);



        //receipt indirect income
        $receipt_indirect_income_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_indirect_income_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


         //payment indirect income
         $payment_indirect_income_data = PaymentVoucher::with('PaymentParticulars')
         ->whereHas('PaymentParticulars',function($query){
             $query->whereHas('debit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                 });
             })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

         $payment_indirect_income_opening_data = PaymentVoucher::with('PaymentParticulars')
         ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            })->orWhereHas('credit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
               });
           });
        })
         ->where('date','>=',$companyDetail->from)
         ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();



        //journal indirect income
        $journal_indirect_income_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_indirect_income_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_indirect_income    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'indirect income');
        })
        ->select('id','name')->get();

        $journal_indirect_income = getJournalProfitLossInfo($secondaryvalue_indirect_income,$journal_indirect_income_data,$receipt_indirect_income_data,$payment_indirect_income_data,$journal_indirect_income_opening_data,$payment_indirect_income_opening_data,$receipt_indirect_income_opening_data);



        //receipt direct income
        $receipt_direct_income_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_direct_income_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


          //payment direct income
          $payment_direct_income_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('debit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                  });
              })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $payment_direct_income_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            })->orWhereHas('credit', function ($query) {
              $query->whereHas('primaryGroup', function ($query) {
                  $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
              });
          });
        })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();



        //journal direct income
        $journal_direct_income_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_direct_income_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_direct_income    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'direct income');
        })
        ->select('id','name')->get();

        $journal_direct_income = getJournalProfitLossInfo($secondaryvalue_direct_income,$journal_direct_income_data,$receipt_direct_income_data,$payment_direct_income_data,$journal_direct_income_opening_data,$payment_direct_income_opening_data,$receipt_direct_income_opening_data);


         //receipt purchase
         $receipt_purchases_data = ReceiptVoucher::with('receiptParticulars')
         ->whereHas('receiptParticulars',function($query){
             $query->whereHas('debit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                 });
             })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $receipt_purchases_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            })->orWhereHas('credit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
               });
           });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


         //payment purchase
         $payment_purchase_data = PaymentVoucher::with('PaymentParticulars')
         ->whereHas('PaymentParticulars',function($query){
             $query->whereHas('debit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                 });
             })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $payment_purchases_opening_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            })->orWhereHas('credit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
               });
           });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //journal purchase
        $journal_purchases_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_purchases_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_purchases    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'purchases');
        })
        ->select('id','name')->get();

        $journal_purchases = getJournalProfitLossInfo($secondaryvalue_purchases,$journal_purchases_data,$receipt_purchases_data,$payment_purchase_data,$journal_purchases_opening_data,$payment_purchases_opening_data,$receipt_purchases_opening_data);


        //receipt sales
        $receipt_sales_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_sales_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


         //payment sales
         $payment_sales_data = PaymentVoucher::with('PaymentParticulars')
         ->whereHas('PaymentParticulars',function($query){
             $query->whereHas('debit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                 });
             })->orWhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

         $payment_sales_opening_data = PaymentVoucher::with('PaymentParticulars')
         ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            })->orWhereHas('credit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
               });
           });
        })
         ->where('date','>=',$companyDetail->from)
         ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal sales
        $journal_sales_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            })->orwhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $journal_sales_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            })->orwhereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
                });
            });
        })
         ->where('date','>=',$companyDetail->from)
         ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        $secondaryvalue_sales    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'profit & loss a/c')->where('classfication', 'sales');
        })
        ->select('id','name')->get();

        $journal_sales = getJournalProfitLossInfo($secondaryvalue_sales,$journal_sales_data,$receipt_sales_data,$payment_sales_data,$journal_sales_opening_data,$payment_sales_opening_data,$receipt_sales_opening_data);

        /**
         *  End of Journal Entry,Receipt & Payment (Profit and Loss A/C)
         *
         */



        return view('admin.profit_loss.individual',compact('from','to','journal_sales','journal_direct_expenses','journal_indirect_expenses','journal_indirect_income','journal_direct_income','journal_purchases','journal_sales'));

    }

}
