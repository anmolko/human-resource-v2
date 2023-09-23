<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\SecondaryGroup;
use App\Models\PrimaryGroup;
use App\Models\JournalEntry;
use App\Models\PaymentVoucher;
use App\Models\JournalParticular;
use App\Models\ReceiptVoucher;
use App\Models\ContraVoucher;
use App\Models\ContraVoucherParticulars;
use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class BalanceSheetController extends Controller
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
        return view('admin.balance_sheet.index');

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
         *  Contra, Journal Entry,Receipt & Payment (Balance Sheet)
         *
         */

        //contra capital account
        $contra_capital_account_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $contra_capital_account_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


         //receipt capital account
        $receipt_capital_account_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_capital_account_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

          //payment capital account
          $payment_capital_account_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


          $payment_capital_account_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
                $query->whereHas('credit', function ($query) {
                    $query->whereHas('primaryGroup', function ($query) {
                        $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                    });
                })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
            })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


          //journal capital account
        $journal_capital_account_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_capital_account_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_capital_account    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'liabilities')->where('classfication', 'capital account');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_capital_account    = PrimaryGroup::where('nature', 'liabilities')
                                            ->where('classfication', 'capital account')->get();


        $journal_capital_account = getBalanceSheetLiabilitiyInfo($primary_capital_account,$secondaryvalue_capital_account,$journal_capital_account_data,$receipt_capital_account_data,$payment_capital_account_data,$contra_capital_account_data,$journal_capital_account_opening_data,$payment_capital_account_opening_data,$receipt_capital_account_opening_data,$contra_capital_account_opening_data);


         //contra current liabilities
         $contra_current_liabilities_data = ContraVoucher::with('contraParticulars')
         ->whereHas('contraParticulars',function($query){
             $query->whereHas('credit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                 });
             })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

         $contra_current_liabilities_opening_data = ContraVoucher::with('contraParticulars')
         ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
               });
           });
        })
         ->where('date','>=',$companyDetail->from)
         ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //receipt current liabilities
        $receipt_current_liabilities_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_current_liabilities_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //payment current liabilities
        $payment_current_liabilities_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $payment_current_liabilities_opening_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal current liabilities
        $journal_current_liabilities_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_current_liabilities_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        $secondaryvalue_current_liabilities    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'liabilities')->where('classfication', 'current liabilities');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_current_liabilities   = PrimaryGroup::where('nature', 'liabilities')
                                         ->where('classfication', 'current liabilities')->get();

        $journal_current_liabilities = getBalanceSheetLiabilitiyInfo($primary_current_liabilities,$secondaryvalue_current_liabilities,$journal_current_liabilities_data,$receipt_current_liabilities_data,$payment_current_liabilities_data,$contra_current_liabilities_data,$journal_current_liabilities_opening_data,$payment_current_liabilities_opening_data,$receipt_current_liabilities_opening_data,$contra_current_liabilities_opening_data);


        //contra non current liabilities
        $contra_non_current_liabilities_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $contra_non_current_liabilities_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //receipt non current liabilities
        $receipt_non_current_liabilities_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_non_current_liabilities_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //payment non current liabilities
        $payment_non_current_liabilities_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $payment_non_current_liabilities_opening_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal non current liabilities
        $journal_non_current_liabilities_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_non_current_liabilities_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_non_current_liabilities    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'liabilities')->where('classfication', 'non current liabilities');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_non_current_liabilities   = PrimaryGroup::where('nature', 'liabilities')
                                             ->where('classfication', 'non current liabilities')->get();

        $journal_non_current_liabilities = getBalanceSheetLiabilitiyInfo($primary_non_current_liabilities,$secondaryvalue_non_current_liabilities,$journal_non_current_liabilities_data,$receipt_non_current_liabilities_data,$payment_non_current_liabilities_data,$contra_non_current_liabilities_data,$journal_non_current_liabilities_opening_data,$payment_non_current_liabilities_opening_data,$receipt_non_current_liabilities_opening_data,$contra_non_current_liabilities_opening_data);


        //contra non current assets
        $contra_non_current_assets_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $contra_non_current_assets_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //receipt non current assets
        $receipt_non_current_assets_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_non_current_assets_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

          //payment non current assets
          $payment_non_current_assets_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'non current assets');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $payment_non_current_assets_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
              $query->whereHas('primaryGroup', function ($query) {
                  $query->where('nature', 'assets')->where('classfication', 'non current assets');
              });
          });
        })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //journal non current assets
        $journal_non_current_assets_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_non_current_assets_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        $secondaryvalue_non_current_assets    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'assets')->where('classfication', 'non current assets');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_non_current_assets   = PrimaryGroup::where('nature', 'assets')
        ->where('classfication', 'non current assets')->get();

        $journal_non_current_assets = getBalanceSheetAssetInfo($primary_non_current_assets,$secondaryvalue_non_current_assets,$journal_non_current_assets_data,$receipt_non_current_assets_data,$payment_non_current_assets_data,$contra_non_current_assets_data,$journal_non_current_assets_opening_data,$payment_non_current_assets_opening_data,$receipt_non_current_assets_opening_data,$contra_non_current_assets_opening_data);


         //contra current assets
         $contra_current_assets_data = ContraVoucher::with('contraParticulars')
         ->whereHas('contraParticulars',function($query){
             $query->whereHas('credit', function ($query) {
                 $query->whereHas('primaryGroup', function ($query) {
                     $query->where('nature', 'assets')->where('classfication', 'current assets');
                 });
             })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
         })
         ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

         $contra_current_assets_opening_data = ContraVoucher::with('contraParticulars')
         ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            })->orWhereHas('debit', function ($query) {
               $query->whereHas('primaryGroup', function ($query) {
                   $query->where('nature', 'assets')->where('classfication', 'current assets');
               });
           });
        })
         ->where('date','>=',$companyDetail->from)
         ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //receipt current assets
        $receipt_current_assets_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_current_assets_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


          //payment current assets
          $payment_current_assets_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'current assets');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $payment_current_assets_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'current assets');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
          })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //journal current assets
        $journal_current_assets_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_current_assets_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_current_assets    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'assets')->where('classfication', 'current assets');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_current_assets   = PrimaryGroup::where('nature', 'assets')
        ->where('classfication', 'current assets')->get();

        $journal_current_assets = getBalanceSheetAssetInfo($primary_current_assets,$secondaryvalue_current_assets,$journal_current_assets_data,$receipt_current_assets_data,$payment_current_assets_data,$contra_current_assets_data,$journal_current_assets_opening_data,$payment_current_assets_opening_data,$receipt_current_assets_opening_data,$contra_current_assets_opening_data);



        //contra fixed assets
        $contra_fixed_assets_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $contra_fixed_assets_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        //receipt fixed assets
        $receipt_fixed_assets_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_fixed_assets_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

          //payment fixed assets
          $payment_fixed_assets_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $payment_fixed_assets_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
          })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //journal fixed assets
        $journal_fixed_assets_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_fixed_assets_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        $secondaryvalue_fixed_assets    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'assets')->where('classfication', 'fixed assets');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_fixed_assets   = PrimaryGroup::where('nature', 'assets')
        ->where('classfication', 'fixed assets')->get();

        $journal_fixed_assets = getBalanceSheetAssetInfo($primary_fixed_assets,$secondaryvalue_fixed_assets,$journal_fixed_assets_data,$receipt_fixed_assets_data,$payment_fixed_assets_data,$contra_fixed_assets_data,$journal_fixed_assets_opening_data,$payment_fixed_assets_opening_data,$receipt_fixed_assets_opening_data,$contra_fixed_assets_opening_data);



        //contra investment
        $contra_investment_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $contra_investment_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //receipt investment
        $receipt_investment_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_investment_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

          //payment investment
          $payment_investment_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'investment');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
          })
          ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

          $payment_investment_opening_data = PaymentVoucher::with('PaymentParticulars')
          ->whereHas('PaymentParticulars',function($query){
              $query->whereHas('credit', function ($query) {
                  $query->whereHas('primaryGroup', function ($query) {
                      $query->where('nature', 'assets')->where('classfication', 'investment');
                  });
              })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
          })
          ->where('date','>=',$companyDetail->from)
          ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();

        //journal investment
        $journal_investment_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $journal_investment_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query){
            $query->whereHas('credit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            })->orWhereHas('debit', function ($query) {
                $query->whereHas('primaryGroup', function ($query) {
                    $query->where('nature', 'assets')->where('classfication', 'investment');
                });
            });
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $secondaryvalue_investment    = SecondaryGroup::with('primaryGroup')
        ->whereHas('primaryGroup',function($query){
                    $query->where('nature', 'assets')->where('classfication', 'investment');
        })
        ->select('id','primary_group_id','name')->get();

        $primary_investment   = PrimaryGroup::where('nature', 'assets')
        ->where('classfication', 'investment')->get();


        $journal_investment = getBalanceSheetAssetInfo($primary_investment,$secondaryvalue_investment,$journal_investment_data,$receipt_investment_data,$payment_investment_data,$contra_investment_data,$journal_investment_opening_data,$payment_investment_opening_data,$receipt_investment_opening_data,$contra_investment_opening_data);

        /**
         *  End of Contra, Journal Entry,Receipt & Payment (Balance Sheet)
         *
         */

        if($companyDetail->from){
            $start_company_date =  $companyDetail->from;
        }else{
            $start_company_date =  $request->input('date_from');

        }


        $profitloss = $this->profitLoss($start_company_date,$request->input('date_to'));


        return view('admin.balance_sheet.individual',compact('profitloss','from','to','journal_capital_account','journal_current_liabilities','journal_non_current_liabilities','journal_non_current_assets','journal_current_assets','journal_fixed_assets','journal_investment'));

    }


    public function profitLoss($date_from,$date_to)
    {
        $themeDetail = ThemeSetting::first();
        $companyDetail = CompanySetting::first();

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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
         ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
         ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
         ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
         ->where('date', '<',$date_from)->orderBy('date','desc')->get();

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
         ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
         ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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

       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
        ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
        ->where('date', '<',$date_from)->orderBy('date','desc')->get();



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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
         ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
         ->where('date', '<',$date_from)->orderBy('date','desc')->get();



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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
        ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
        ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();

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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
       ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
        ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();

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
        ->where('date', '<',$date_from)->orderBy('date','desc')->get();


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
       ->whereBetween('date', [$date_from, $date_to])->orderBy('date','desc')->get();


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
        ->where('date', '<',$date_from)->orderBy('date','desc')->get();

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

        $left_section_first = @$journal_purchases['grand_amount'] + @$journal_direct_expenses['grand_amount'];
        $right_section_first = @$journal_sales['grand_amount'] + @$journal_direct_income['grand_amount'];

        if($right_section_first > $left_section_first){
            $gross_profit = $right_section_first - $left_section_first;

        }else{
            $gross_profit = 0;
        }

        $first_left_total = $gross_profit + $left_section_first;

        if($left_section_first > $right_section_first){
          $gross_loss = $left_section_first - $right_section_first;

        }else{
            $gross_loss = 0;
        }

       $first_right_total = $gross_loss  + $right_section_first ;

        $left_section_second = @$gross_loss + @$journal_indirect_expenses['grand_amount'];
        $right_section_second = @$gross_profit + @$journal_indirect_income['grand_amount'];

       if($right_section_second > $left_section_second){
        $nett_profit = $right_section_second - $left_section_second;

       }else{
        $nett_profit = 0;
       }

        $second_left_total = $nett_profit  + $left_section_second ;

        if($left_section_second > $right_section_second){
            $nett_loss = $left_section_second - $right_section_second;

        }else{
            $nett_loss = 0;
        }

         $second_right_total = $nett_loss  + $right_section_second ;

         $data = array(
            'nett_loss' => $nett_loss,
            'nett_profit' => $nett_profit
        );
        return $data;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
